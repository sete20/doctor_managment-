<?php

namespace Modules\Courses\Http\Controllers\Dashboard;

use FFMpeg\Media\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Courses\Entities\Chapter;
use Modules\Core\Traits\DataTable;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Lesson;
use Modules\Courses\Http\Requests\Dashboard\ChapterRequest;
use Modules\Courses\Transformers\Dashboard\ChapterResource;
use Modules\Courses\Repositories\Dashboard\ChapterRepository;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class VideoController extends Controller
{
    use CrudDashboardController {
        __construct as private __CrudConstruct;
    }

    function __construct()
    {
        $this->__CrudConstruct();
        $this->setModel(Lesson::class);
        $this->setViewPath('courses::dashboard.contents.videos');
    }


    public function show($id)
    {
        $video = $this->repository->findById($id);
        $views = $video->clientCompletes()->paginate(10);
        return $this->view('show', compact('views', 'video'));
    }

    public function edit($id)
    {
        $model = $this->repository->findById($id);
        if ($model && $model->video_status == 'process')
            abort(404);

        return $this->view('edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $request = App::make($this->request);

        $model = $this->repository->findById($id);
        if ($model && $model->video_status == 'process')
            abort(404);

        try {
            $update = $this->repository->update($request,$id);

            if ($update) {
                return Response()->json([true , __('app::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }


    public function storeCustomized()
    {
        $video = Lesson::where('type', 'video')->where('video_status', 'ready')->first();
        $video->update(\request()->all() + ['video_status' => 'ready']);
    }


    public function chunkUpload(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }
        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = '_' . md5(time()) . '.' . $extension; // a unique file name


            $source = "storage/" . $file->store('videos', 'public');
            Lesson::create([
                'source' => $source,
                'type' => 'video',
                'video_status' => 'process',
                'order' => $request->order ? $request->order : $this->model->count() + 1
            ]);


            // delete chunked file
            unlink($file->getPathname());
        }
        // otherwise return percentage informatoin

        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
