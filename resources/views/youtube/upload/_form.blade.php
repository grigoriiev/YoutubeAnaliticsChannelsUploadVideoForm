
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{old('title',$localVideo->title)}}">
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Category id</label>
        <input type="number" name="category_id" class="form-control" id="exampleFormControlInput2" placeholder="" value="{{old('category_id',$localVideo->category_id)}}">
        @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Tag 1</label>
        <input type="text" name="tag_1" class="form-control" id="exampleFormControlInput3" placeholder="" value="{{old('tag_1', unserialize($localVideo->tags)[0])}}">
        @error('tag_1')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput4">Tag 2</label>
        <input type="text" name="tag_2" class="form-control" id="exampleFormControlInput4" placeholder="" value="{{old('tag_2',unserialize($localVideo->tags)[1])}}">
        @error('tag_2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput5">Tag 3</label>
        <input type="text" name="tag_3" class="form-control" id="exampleFormControlInput5" placeholder="" value="{{old('tag_3',unserialize($localVideo->tags)[2])}}">
        @error('tag_3')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Example file input video</label>
        <input type="file" name="video" class="form-control-file" id="exampleFormControlFile1"  >
        @error('video')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile2">Example file input image</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile2" >
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" >{{$localVideo->description}}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="customControlInline">Check me out</label>
        <input type="checkbox" id="customControlInline" name="check" >
        @error('check')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary my-1">Submit</button>

