   <div class="form-group">
       <label for="title"> Title</label>
       {!!Form::text('title',null,[
       'class'=>'form-control'
       ])!!}
   </div>
   <div class="form-group">
       <label for="content"> Content</label>
       {!!Form::textarea('content',null,[
       'class'=>'form-control'
       ])!!}
   </div>
   <div class="form-group">
       <label for="photo">Photo</label>
       {!!Form::file('photo',[
       'class'=>'form-control',
       'accept'=>'image/*'
       ])!!}

   </div>
   <div class="form-group">
       <label for="category_id">category</label>
       {!!Form::select('category_id',$categories,null,[
       'class'=>'form-control',
       'placeholder'=>'select category'
       ])!!}
   </div>
   <div class="form-group ">
       <button class="btn btn-primary" type="submit">Submit</button>
   </div>