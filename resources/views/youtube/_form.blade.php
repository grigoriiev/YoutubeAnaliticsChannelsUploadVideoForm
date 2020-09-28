<div class="form-group">
    <label for="exampleInputEmail1">Channel Id</label>
    <input type="text" name="channel_Id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    @error('channel_Id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group form-check">
    <input type="checkbox" name="check"  class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
    <small id="checkboxHelp" class="form-text text-muted"></small>
    @error('check')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" id="formButton" class="btn btn-primary">Submit</button>
