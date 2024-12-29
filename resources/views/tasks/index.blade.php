<!-- resources/views/tasks/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE TAREAS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .task-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .task-container p {
            font-size: 16px;
            color: #555;
        }

        .task-form, .create-task-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .task-form label, .create-task-form label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .task-form input, .create-task-form input,
        .task-form textarea, .create-task-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .task-form button, .create-task-form button, .delete-task-btn {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .task-form button:hover, .create-task-form button:hover, .delete-task-btn:hover {
            background-color: #4cae4c;
        }

        .delete-task-btn {
            background-color: #d9534f;
            margin-top: 10px;
        }

        .task-form input[type="checkbox"] {
            margin-top: 10px;
        }

        .task-container hr {
            border: 1px solid #eee;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <h1>LISTA DE TAREAS</h1>

    <!-- Lista de tareas existentes -->
    @foreach ($tasks as $task)
        <div class="task-container">
            <p><strong>{{ $task->title }}</strong> - {{ $task->description }} - 
                <span style="color: {{ $task->completed ? 'green' : 'red' }};">
                    {{ $task->completed ? 'Completada' : 'No completada' }}
                </span>
            </p>

            <!-- Formulario para actualizar la tarea -->
            <form action="/tasks/{{ $task->id }}" method="POST" class="task-form">
                @csrf
                @method('PUT')

                <label for="title">Título:</label>
                <input type="text" name="title" value="{{ $task->title }}" required>

                <label for="description">Descripción:</label>
                <textarea name="description" required>{{ $task->description }}</textarea>

                <label for="completed">Completada:</label>
                <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }}>

                <button type="submit">Actualizar tarea</button>
            </form>

            <!-- Botón para eliminar la tarea -->
            <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-task-btn">Eliminar tarea</button>
            </form>
        </div>
    @endforeach

    <!-- Formulario para crear una nueva tarea -->
    <div class="create-task-form">
        <h2>Crear una nueva tarea</h2>
        <form action="/tasks" method="POST">
            @csrf
            <label for="title">Título:</label>
            <input type="text" name="title" required>

            <label for="description">Descripción:</label>
            <textarea name="description" required></textarea>

            <label for="completed">Completada:</label>
            <input type="checkbox" name="completed">

            <button type="submit">Crear tarea</button>
        </form>
    </div>

</body>
</html>
