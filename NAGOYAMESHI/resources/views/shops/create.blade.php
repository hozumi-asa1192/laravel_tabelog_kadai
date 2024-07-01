@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <h1>新しい商品を追加</h1>
 
     <form action="{{ route('shops.store') }}" method="POST">
         @csrf
         <div class="form-group">
             <label for="shop-name">商品名</label>
             <input type="text" name="name" id="shop-name" class="form-control">
         </div>
         <div class="form-group">
             <label for="shop-description">商品説明</label>
             <textarea name="description" id="shop-description" class="form-control"></textarea>
         </div>
         <div class="form-group">
             <label for="shop-price">価格</label>
             <input type="number" name="price" id="shop-price" class="form-control">
         </div>
         <div class="form-group">
             <label for="shop-category">カテゴリ</label>
             <select name="category_id" class="form-control" id="shop-category">
                 @foreach ($categories as $category)
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                 @endforeach
             </select>
         </div>
         <button type="submit" class="btn btn-success">商品を登録</button>
     </form>
 
     <a href="{{ route('products.index') }}">商品一覧に戻る</a>
 </div>
 @endsection