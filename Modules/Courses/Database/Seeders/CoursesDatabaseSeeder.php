<?php

namespace Modules\Courses\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Category\Entities\Category;
use Modules\Courses\Entities\Course;
use Modules\Courses\Repositories\Dashboard\QuizRepository;
use Modules\Doctors\Entities\Doctor;

class CoursesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCources();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function createCources()
    {
        $doctors = Doctor::pluck('id')->toArray();
        foreach (Category::doesnthave('children')->get() as $category) {

            for ($i = 0; $i < 5; $i++) {

                $price = rand(500, 4000);
                $course = $category->courses()->create([
                    'image' => 'uploads/testing.png',
                    'intro' => 'uploads/testing.mp4',
                    'price' => $price,
                    'offer_price' => $price / 2,
                    'is_offered' => rand(0, 1),
                    'status' => 1,
                    'doctor_id' => $doctors[rand(0, count($doctors) - 1)],
                ]);

                $course->translateOrNew('en')->title = 'Course - ' . $course->id;
                $course->translateOrNew('en')->description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum';
                $course->translateOrNew('en')->note = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum';

                $course->translateOrNew('ar')->title = 'كورس - ' . $course->id;
                $course->translateOrNew('ar')->description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum';
                $course->translateOrNew('ar')->note = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum';
                $course->save();

                $this->createChapters($course);
            }
        }
    }

    public function createChapters($course)
    {
        for ($i = 0; $i < 10; $i++) {

            $chapter = $course->chapters()->create([
                'status' => 1,
                'order' => $i + 1,
            ]);

            $chapter->translateOrNew('en')->title = 'Chapter - ' . $chapter->id;
            $chapter->translateOrNew('ar')->title = 'الفصل -' . $chapter->id;
            $chapter->save();

            for ($j = 1; $j < 5; $j++) {

                $chapter->attachmentRelation()->create([
                    'path' => 'uploads/testing.pdf',
                    'type' => 'image',
                ]);
            }
            $this->createLessons($chapter);
        }
    }

    public function createLessons($chapter)
    {
        $types = ['video', 'quiz', 'card'];
        for ($i = 0; $i < 10; $i++) {
            $type = $types[rand(0, count($types) - 1)];
            $lesson = $chapter->lessons()->create([
                'type' => $type,
                'status' => 1,
                'order' => $i + 1,
            ]);

            $lesson->translateOrNew('en')->title = $type . ' - ' . $lesson->id;
            $lesson->translateOrNew('en')->description = 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using  making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for  will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like   ';

            $lesson->translateOrNew('ar')->title = $type . ' - ' . $lesson->id;
            $lesson->translateOrNew('ar')->description = 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using  making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for  will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like   ';
            $lesson->save();

            if ($type == 'quiz')
                $this->createQuiz($lesson);
        }
    }

    public function createQuiz($lesson)
    {
        $request = new Request();
        $request->merge([
            "chapter_id" => "1",
            "status" => 1,
            "questions" => [
                2230147688 => "quiestion 1 test ?",
                8872105899 => "quiestion 2 test ?",
                8854379971 => "quiestion 3 test ?",
                4736937075 => "quiestion 4 test ?",
                4575363918 => "quiestion 5 test ?",
            ],
            "answers" => [
                2230147688 => [
                    5061810273 => "answer 1",
                    2576942016 => "answer 2",
                ],
                8872105899 => [
                    1287352541 => "answer 1",
                    1358315086 => "answer 2",
                ],
                8854379971 => [
                    4945740357 => "answer 1",
                    8467164198 => "answer 2",
                ],
                4736937075 => [
                    3959692028 => "answer 1",
                    5659263917 => "answer 2",
                ],
                4575363918 => [
                    9606029721 => "answer 1",
                    8298058311 => "answer 2",
                ],
            ],
            "is_true_answer" => [
                5061810273 => "1",
                1358315086 => "1",
                4945740357 => "1",
                3959692028 => "1",
                8298058311 => "1",
            ],
            "order" => 6,
            "type" => "quiz",
        ]);

        foreach ($request->questions as $question_key => $question) {
            $question = $lesson->questions()->create([
                'status' => 1,
                'title' => $question,
            ]);

            if (isset($request->answers[$question_key])) {
                foreach ($request->answers[$question_key] as $answer_key => $answer) {
                    $question->answers()->create([
                        'status' => 1,
                        'title' => $answer,
                        'true_answer' => isset($request->is_true_answer[$answer_key]) ? 1 : 0
                    ]);
                }
            }
        }
    }
}
