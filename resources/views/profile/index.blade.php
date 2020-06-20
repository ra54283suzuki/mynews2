<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Index</title>
    </head>
    <body>
    @extends('layouts.front')

    @section('content')
        <div class="container">
            <hr color="#c0c0c0">
            <div class="row">
                <div class="posts col-md-8 mx-auto mt-3">
                    @foreach($posts as $post)
                        <div class="post">
                            <div class="row">
                                <div class="text col-md-6">
                                    <div class="date">
                                        登録日：{{ $post->updated_at->format('Y年m月d日') }}
                                    </div>
                                    <div class="name">
                                        氏名：{{ str_limit($post->name, 50) }}
                                    </div>
                                    <div class="gender">
                                        性別：{{ str_limit($post->gender, 50) }}
                                    </div>
                                    <div class="hobby">
                                        趣味：{{ str_limit($post->hobby, 50) }}
                                    </div>
                                    <div class="introduction">
                                        自己紹介：{{ str_limit($post->introduction, 500) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr color="#c0c0c0">
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    @endsection
    </body>
</html>