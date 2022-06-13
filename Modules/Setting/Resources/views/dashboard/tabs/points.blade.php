<div class="tab-pane fade" id="points">
    <div class="form-body">
        <h3 class="page-title">إعدادات النقاط</h3>
        <div class="col-md-10">
            <div class="form-group">
                <label class="col-md-2">
                    عدد النقاط علي مشاهدة الفيديو
                </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" name="points[video]" value="{{setting('points','video')}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    عدد النقاط علي حل الإمتحانات
                </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" name="points[quiz]" value="{{setting('points','quiz')}}" />
                </div>
            </div>
        </div>
    </div>
</div>
