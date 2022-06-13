@extends('app::dashboard.layouts.app')
@section('title', 'عرض')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('app::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.contents.index')) }}">
                            {{__('courses::dashboard.contents.quiz.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">عرض</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($quizAnsweres))
                                        @foreach($quizAnsweres as $student_answer)
                                            <div class="card" style="padding: 20px;">
                                                <div class="card-body p-0">
                                                    <div class="table-responsive table-invoice">
                                                        <p><strong>إسم الطالب :</strong> {{optional($student_answer->client)->name}}
                                                        </p>
                                                        <p><strong>الدرجة
                                                                :</strong> {{optional($student_answer)->wright_answers_count}}
                                                            / {{optional($student_answer)->question_count}}</p>


                                                        <table class="table table-striped">
                                                            <tbody>
                                                            <tr>
                                                                <th>السؤال</th>
                                                                <th>الإجابة الصحيحة</th>
                                                                <th>إجابة الطالب</th>
                                                                <th>التصحيح</th>
                                                            </tr>
                                                            @if($quiz->questions()->count())
                                                                @foreach($quiz->questions as $questions)
                                                                    @php
                                                                        $client_answer = $questions->clientAnswers()->where('client_id',$student_answer->client_id)->first();
                                                                        if($client_answer){
                                                                        $answer = $client_answer->answer;
                                                                        $is_true_answer = $client_answer->answer->true_answer ? true : false;
                                                                        }else{
                                                                            $answer = null;
                                                                            $is_true_answer = false;
                                                                        }
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $questions->title }}</td>
                                                                        <td>
                                                                            @foreach($questions->wrightAnswer as $wrightAnswer)
                                                                                <label class="label label-primary">{{ $wrightAnswer->title }}</label>
                                                                                @php $is_true_answer =  $answer && $answer->id == $wrightAnswer->id ? true : false;@endphp
                                                                            @endforeach
                                                                        </td>

                                                                        <td>{{ optional($answer)->title }}</td>
                                                                        <td>
                                                                            @if($is_true_answer)
                                                                                <label class="label label-success">إجابة صحيحة</label>
                                                                            @else
                                                                                <label class="label label-danger">إجابة خطأ</label>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <div class="text-center p-3 text-muted">
                                                                            <h5>لا يوجد إسئلة</h5>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="table-responsive table-invoice">
                                                    <div class="text-center p-3 text-muted">
                                                        <h5>لا يوجد إجابات</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($quizAnsweres)>0)
                                        <div class="text-center">
                                            {{ $quizAnsweres->appends(Request::except('page'))->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@stop
