<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($picture->title) ? $picture->title : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($picture->description) ? $picture->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <label for="photo" class="control-label">{{ 'Photo' }}</label>
    <input class="form-control" name="photo" type="file" id="photo" value="{{ isset($picture->photo) ? $picture->photo : ''}}" >
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group {{ $errors->has('album_id') ? 'has-error' : ''}}">
    <label for="album_id" class="control-label">{{ 'Album' }}</label>
    <select class="form-control" name="album_id"  id="album_id" value="{{ isset($picture->album_id) ? $picture->album_id : ''}}" >
          
          
    @if(isset($picture->album))
        <option value="{{ $picture->album->id }}" selected>{{ $picture->album->name }}</option>

        @foreach ($albums->where('id','!==',$picture->album->id) as $album)
        <option value="{{ $album->id }}">{{ $album->name }}</option>
        @endforeach
    @else
        @foreach ($albums as $album)
            <option value="{{ $album->id }}">{{ $album->name }}</option>
        @endforeach
    @endif
    </select>
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
