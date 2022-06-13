<div class="questions-form">
    @foreach($model->questions as $question)
        <div class="form-group portlet light bordered">
            <div class="row">
                <div class="portlet-title">
                    <div class="col-xs-10">
                        <div class="form-group " id="questions[::index]_wrap">
                            <label for="questions[{{$question->id}}]" class="col-md-2"
                                   style="">{{__('courses::dashboard.contents.quiz.form.question')}}</label>
                            <div class="col-md-9" style="">
                                <input placeholder="{{__('courses::dashboard.contents.quiz.form.question')}}"
                                       class="form-control" data-name="questions.{{$question->id}}"
                                       id="questions[{{$question->id}}]"
                                       name="questions[{{$question->id}}]" type="text" value="{{$question->title}}">
                                <span class="help-block" style="">
                                  </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="form-group " id="image[::index]_wrap">
                            <label for="image[{{$question->id}}]" class="col-md-2"
                                   style="">صورة</label>
                            <div class="col-md-9" style="">
                                <div class="col-md-9" style="">
                                    <input placeholder="صورة"
                                           class="form-control" data-name="image.{{$question->id}}"
                                           id="image[{{$question->id}}]"
                                           name="image[{{$question->id}}]" type="file">
                                    <span class="help-block" style="">
                                  </span>
                                </div>
                                <span class="holder" style="margin-top:15px;max-height:100px;">
                                @if($question->getFirstMediaUrl('image'))
                                        <img src="{{$question->getFirstMediaUrl('image')}}" style="height: 15rem;">
                                    @endif
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                      <span class="input-group-btn">
                          <a class="btn btn-circle btn-icon-only btn-danger delete-question"
                             href="javascript:;" style="float: left;">
                              <i class="fa fa-trash"></i>
                          </a>
                      </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-lg-10">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success btn-sm"
                                        onclick="addAnswer(event, '{{$question->id}}')">
                                    <i class="fa fa-plus-circle"></i>
                                    {{__('courses::dashboard.contents.quiz.form.btn_add_more')}}
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{__('courses::dashboard.contents.quiz.form.answer')}}</th>
                                <th>{{__('courses::dashboard.contents.quiz.form.is_true_answer')}}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="table_content_{{$question->id}}">
                            @foreach($question->answers()->get() as $answer)
                                <tr class="collapse-custom-time" id="{{$answer->id}}">
                                    <td>
                                        <div class="form-group " id="answers[{{$answer->id}}]_wrap">
                                            <div class="col-md-12" style="">
                                                <input placeholder="{{__('courses::dashboard.contents.quiz.form.answer')}}"
                                                       class="form-control" data-name="answers.{{$answer->id}}"
                                                       id="answers[{{$answer->id}}]"
                                                       name="answers[{{$question->id}}][{{$answer->id}}]"
                                                       type="text" value="{{$answer->title}}">
                                                <span class="help-block" style=""></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input placeholder="" class="switch" data-size="small"
                                                   data-name="is_true_answer{{$question->id}}.{{$answer->id}}"
                                                   name="is_true_answer[{{$answer->id}}]"
                                                   type="checkbox" {{$answer->true_answer ? 'value="1"' : ''}}
                                                    {{$answer->true_answer ? 'checked="checked"' : ''}}>
                                            <span class="help-block" style="">
                                  </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger"
                                                onclick="removeAnswer('{{$answer->id}}')"><i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="form-group">
    <button
            type="button"
            class="btn green btn-lg mt-ladda-btn ladda-button btn-circle btn-outline add-question"
            data-style="slide-down"
            data-spinner-color="#333">
         <span class="ladda-label">
                <i class="icon-plus"></i>
        </span>
    </button>
</div>

@push('styles')
    <style>
        .get-questions-form a {
            display: none;
        }
    </style>
@endpush
@push('scripts')
    <script>

        var indexes = [];
        var answers_indexes = [];

        $(document).ready(function () {
            var html = '<div class="form-group portlet light bordered">' +
                '        <div class="row">' +
                '            <div class="portlet-title">' +
                '                <div class="col-xs-10">' +
                '                    <div class="form-group " id="questions[::index]_wrap">' +
                '                    <label for="questions[::index]" class="col-md-2" style="">{{__('courses::dashboard.contents.quiz.form.question')}}</label>' +
                '                    <div class="col-md-9" style="">' +
                '                <input placeholder="{{__('courses::dashboard.contents.quiz.form.question')}}" class="form-control" data-name="questions.::index" id="questions[::index]" name="questions[::index]" type="text" value="">' +
                '                    <span class="help-block" style="">' +
                '                    </span>' +
                '                            </div>' +
                '            </div>' +
                '                </div>' +
                '<div class="col-md-9" style="">' +
                '                                <input placeholder="صورة"' +
                '                                       class="form-control" data-name="image.::index"' +
                '                                       id="image[::index]"' +
                '                                       name="image[::index]" type="file">' +
                '                                <span class="help-block" style="">' +
                '                                  </span>' +
                '                            </div>' +
                '                <div class="actions">' +
                '                    <span class="input-group-btn">' +
                '                        <a class="btn btn-circle btn-icon-only btn-danger delete-question" href="javascript:;" style="float: left;">' +
                '                            <i class="fa fa-trash"></i>' +
                '                        </a>' +
                '                    </span>' +
                '                </div>' +
                '            </div>' +
                '            <div class="portlet-body">' +
                '                <div class="col-lg-10">' +
                '                    <div class="row" style="margin-bottom: 5px;">' +
                '                            <div class="col-md-3">' +
                '                                <button type="button" class="btn btn-success btn-sm" onclick="addAnswer(event, \'::index\')">' +
                '                                    <i class="fa fa-plus-circle"></i>' +
                '                                  {{__('courses::dashboard.contents.quiz.form.btn_add_more')}}' +
                '                                </button>' +
                '                            </div>' +
                '                        </div><table class="table table-striped table-bordered table-hover">' +
                '                        <thead>' +
                '                        <tr>' +
                '                            <th>{{__('courses::dashboard.contents.quiz.form.answer')}}</th>' +
                '                            <th>{{__('courses::dashboard.contents.quiz.form.is_true_answer')}}</th>' +
                '                            <th></th>' +
                '                        </tr>' +
                '                        </thead>' +
                '                        <tbody id="table_content_::index">' +
                '                        </tbody>' +
                '                    </table>' +
                '                </div>' +
                '            </div>' +
                '        </div>' +
                '    </div>';

            $(".add-question").click(function (e) {
                var content = html;
                var rand = Math.floor(Math.random() * 9000000000) + 1000000000;
                indexes.push(rand);
                content = replaceAll(content, '::index', rand);
                e.preventDefault();
                $(".questions-form").append(content);

                $("#switch_" + rand).bootstrapSwitch({size: "small", onColor: "success", offColor: "danger"});
            });
        });

        // DELETE member BUTTON
        $(".questions-form").on("click", ".delete-question", function (e) {
            e.preventDefault();
            $(this).closest('.form-group').remove();
        });

        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        }

        /* Define functin to find and replace specified term with replacement string */
        function replaceAll(str, term, replacement) {
            return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
        }
    </script>

    <script>

        function addAnswer(e, index) {
            if (e.preventDefault) {
                e.preventDefault();
            } else {
                e.returnValue = false;
            }

            var rowCount = Math.floor(Math.random() * 9000000000) + 1000000000;
            answers_indexes.push(rowCount);

            var divContent = $('#table_content_' + index);
            var html = '<tr class="collapse-custom-time" id="::answer_index">' +
                '                            <td>' +
                '<div class="form-group " id="answers[::answer_index]_wrap"> ' +
                '<div class="col-md-12" style="">' +
                '<input placeholder="{{__('courses::dashboard.contents.quiz.form.answer')}}" class="form-control" data-name="answers.::answer_index" id="answers[::answer_index]" name="answers[::index][::answer_index]" type="text">                    ' +
                '<span class="help-block" style=""></span>' +
                '                            </div> ' +
                '           </div>' +
                '                            </td>' +
                '                            <td>' +
                '                                <div>' +
                '                <input placeholder="" class="switch" data-size="small" data-name="is_true_answer::index.::answer_index" name="is_true_answer[::answer_index]" type="checkbox" value="1">' +
                '                    <span class="help-block" style="">' +
                '                    </span>' +
                '                            </div>' +
                '                            </td>' +
                '                            <td class="text-center">' +
                '                                <button type="button" class="btn btn-danger" onclick="removeAnswer(\'::answer_index\')"><i class="fa fa-trash"></i>' +
                '                                </button>' +
                '                            </td>' +
                '                        </tr>'
            ;

            var newRow = replaceAll(html, '::answer_index', rowCount);
            newRow = replaceAll(newRow, '::index', index);
            divContent.append(newRow);
            $(".switch").bootstrapSwitch({size: "small", onColor: "success", offColor: "danger"});
        }

        function removeAnswer(answer_index) {
            $('#' + answer_index).remove();
        }


        jQuery(document).ready(function () {
            $(".switch").bootstrapSwitch({size: "small", onColor: "success", offColor: "danger"});
        });
    </script>

@endpush