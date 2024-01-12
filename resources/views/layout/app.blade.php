<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 1.5rem 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav li {
            margin-right: 1.5rem;
        }

        nav a {
            color: black;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease-in-out;
        }

        nav a:hover {
            color: #e74c3c;
        }

        .container {
            display: flex;
        }

        aside {
            flex: 1;
            order: 1;
            min-width: 20%;
            background-color: #3498db;
            padding: 1.5rem;
            height: 100vh;
        }

        aside h2 {
            color: #ecf0f1;
        }

        aside a {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            margin: 1rem 0;
            transition: background-color 0.3s ease-in-out;
        }

        aside a:hover {
            background-color: #2980b9;
        }

        main {
            flex: 2;
            order: 2;
            min-width: 80%;
            background-color: #ecf0f1;
            padding: 1.5rem;
            border-radius: 10px;
        }

        @media screen and (max-width: 600px) {
            nav, .container {
                flex-direction: column;
            }

            aside, main {
                order: 0;
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">My Blogs</a></li>
            <li><a href="#">Home</a></li>
        </ul>
    </nav>

    <div class="container">
        <aside>
            <h2>Menu</h2>
            <a href="{{ route('posts.create') }}">Create Blog</a>
            <a href="{{ route('posts.index') }}">See Blog</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </aside>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
