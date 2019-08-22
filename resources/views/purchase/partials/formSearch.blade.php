<form class="form-inline mb-3" id="dateForm">
    <div class="form-group">
        <label for="datePicker">LoadDate: </label>
        <div class="input-group date " id="datePicker" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" id="loadDate" data-target="#datePicker"/>
            <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-auto">
            <label class="sr-only" for="btsLoadId">btsLoadId</label>
            <select class="form-control myselect2" name="btsLoadId" id="btsLoadId">
                <option value="">-- Select Bts Load Id --</option>
                @foreach($btsLoadIds as $btsLoadId)
                    <option value="{{$btsLoadId}}">{{$btsLoadId}}</option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="form-group ml-2">
        <button type="submit" class="btn btn-primary ml-2">Submit</button>
    </div>
</form>
<hr>
