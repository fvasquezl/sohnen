<form class="form-inline mb-3" id="dateForm">
    <div class="form-group">
        <div class="col-auto">
            <label class="sr-only" for="loadDate">LoadDate</label>
            <select class="form-control myselect2" name="loadDate" id="loadDate">
                <option value="">-- Select Load Date --</option>
                @foreach($loadDates as $loadDate)
                    <option value="{{$loadDate}}">{{$loadDate}}</option>
                @endforeach
            </select>
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
