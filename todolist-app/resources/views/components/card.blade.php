<div class="card">
    <form action="{{ url('todo') }}" method="POST">
        @method('post')
        @csrf
        <div class="form-input">
            <div class="input-box">
                <input type="text" name="title" placeholder="Task to be done..." required>
            </div>
            <button>Add</button>
        </div>
    </form>
    <p>You have {{ $uncompleteDatas }} task(s) to complete.</p>
    <div class="todoList">
        <ul>
            @foreach ($datas as $data)
                <li class="{{ $data->status == 0 ? '' : 'done' }}">
                    <input type="hidden" class="delete_id" value="{{ $data->id }}">
                    <form action="{{ url('todo/complete/' . $data->id) }}" method="post">
                        @csrf
                        <button class="flex">
                            <i
                                class='bx {{ $data->status == 0 ? 'bx-circle check text-[#7e7e7e]' : 'bxs-check-circle check text-[#2d7cc7]' }} '></i>
                        </button>
                    </form>

                    @if ($data->status == 0)
                        <form action="{{ url('todo/' . $data->id) }}" class="todoText" method="POST">
                            @method('put')
                            @csrf
                            <div class="inputWrapper">
                                <input value="{{ $data->title }}" name="title" required disabled></input>
                            </div>
                            <button class="btnSubmit !hidden"><i class="bx bx-check"></i></button>
                        </form>
                    @else
                        <form action="" class="todoText">
                            <span>{{ $data->title }}</span>
                        </form>
                    @endif

                    <div class="action">
                        <button onclick="editTodo(this)" class="edit"><i class='bx bxs-edit'></i></button>
                        <a href="{{ url('todo/delete/' . $data->id) }}" onclick="confirm(event)"><i
                                class='bx bxs-trash'></i></a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
