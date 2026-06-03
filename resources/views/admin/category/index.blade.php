@extends('layouts3.admin')

@section('content')
<div class="container-fluid mt-4">
    <!-- Заголовок и кнопка добавления -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Управление категориями</h1>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Добавить категорию
        </a>
    </div>

    <!-- Сетка категорий -->
    <div class="row">
        @foreach($categories as $category)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    ID: {{ $category->id }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <a href="{{ route('admin.category.show', $category->id) }}" class="text-decoration-none">
                                        {{ $category->title }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <!-- Иконка или изображение категории -->
                                @if($category->image)
                                    <img src="{{ str_starts_with($category->image, 'http') ? $category->image : asset('images/categories/' . $category->image) }}" alt="" style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover;">
                                @else
                                    <i class="fas fa-folder fa-2x text-gray-300"></i>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Кнопки управления -->
                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-edit"></i> Ред.
                            </a>
                            
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Вы уверены?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i> Удал.
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Пагинация -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection