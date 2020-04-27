<script>
    $('.selectpicker').selectpicker({
        noneSelectedText:'انتخاب کنید',
        liveSearch:true,
        noneResultsText:'موردی یافت نشد'
    });
</script>
<style>
    @media screen and (max-width: 400px) {
        #mainDiv{
            padding: 0 !important;
        }
    }
</style>
<div id="mainDiv" class="col-lg-6 pr-0 mb-3">
    <label for="partialservice_id" class="control-label">موضوع جزئی</label>
    <select onchange="getServices()" name="partialservice_id" id="partialservice_id" class="selectpicker">
        <option value="">انتخاب کنید</option>
        @foreach($services as $service)
            <option value="{{$service->id}}">{{$service->title}}</option>
        @endforeach
    </select>
</div>
<div id="mainServiceDiv" class="col-lg-6 pr-0">
    <label for="service_id" class="control-label">موضوع دقیق</label>
    <select name="service_id" id="service_id" class="selectpicker">
        <option value="">انتخاب کنید</option>
    </select>
</div>

