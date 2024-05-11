@extends('layouts.site.inc.layouts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

@section('content')
    <div class="central-meta">
        @if(Auth::check() )
            @if(auth()->user()->is_blocked==0)
                <div class="new-postbox">


                    <div class="newpst-input">

                        <form method="post"  action="{{route('posts.store')}}">
                            @csrf
                            <textarea name="body" rows="3" placeholder="{{trans('main.write_something')}}"></textarea>
                            <div class="attachments">
                                <ul>

                                    <li>
                                        <button type="submit">{{trans(('main.Create'))}}</button>
                                    </li>
                                </ul>
                            </div>
                        </form>

                    </div>
                </div>
            @endif
        @endif
    </div><!-- add post new box -->

    <div class="central-meta item">
        <div class="user-post">
         <h2 class="text-center">{{trans('main.News')}}</h2>
        </div>
    </div>
    @if($posts->count()>0)
        @foreach($posts as $post)
    <div class="central-meta item">
        <div class="user-post">
            <div class="friend-info">
                <figure>
                    @if($post->user() && $post->user->image==null)
                    <img src="{{url('/')}}/site/images/resources/nearly1.jpg" alt="">
                    @else
                        <img src="{{url('/')}}/site/images/resources/nearly1.jpg" alt="">

                    @endif
                </figure>
                <div class="friend-name">
                    <ins><a href="#" title="">  @if($post->user()){{$post->user->name}} @endif</a></ins>
                    <span>{{trans('main.published')}}: {{ $post->created_at->diffForHumans() }}</span>
                </div>

                <div class="post-meta">
                    <div class="description" >

                        <p dir="rtl" class="text-right">

                            {{$post->body}}
                        </p>
                    </div>
<!--
                    <div class="we-video-info">
                        <ul>
&lt;!&ndash;                            <li>
															<span class="views" data-toggle="tooltip" title="views">
																<i class="fa fa-eye"></i>
																<ins>1.2k</ins>
															</span>
                            </li>&ndash;&gt;
                            <li>
															<span class="comment" data-toggle="tooltip" title="Comments">
																<i class="fa fa-comments-o"></i>
																<ins>52</ins>
															</span>
                            </li>
                            <li>
															<span class="like" data-toggle="tooltip" title="like">
																<i class="ti-heart"></i>
																<ins>2.2k</ins>
															</span>
                            </li>
                            <li>
															<span class="dislike" data-toggle="tooltip" title="dislike">
																<i class="ti-heart-broken"></i>
																<ins>200</ins>
															</span>
                            </li>
                            <li class="social-media">
                                <div class="menu">
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
                                        </div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
                                        </div>
                                    </div>
                                    <div class="rotater">
                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
-->

                </div>
            </div>
            <div class="coment-area">
                <?php
                  $comments=\App\Models\Comment::where('post_id',$post->id)->get();


                    ?>
                <ul class="we-comet">
                       @if($comments->count()>0)
                           @foreach($comments as $comment)
                    <li>
                        <div class="comet-avatar">
                            <img src="{{url('/')}}/site/images/resources/comet-1.jpg" alt="">
                        </div>
                        <div class="we-comment">
                            <div class="coment-head">

                                <h5><a href="time-line.html" title="">{{$comment->user->name}}</a></h5>
                                <span>{{$comment->created_at->diffForHumans()}}</span>
                                <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>

                            </div>
                            <p>
                                {{$comment->comment}}
                            </p>
                            @if(Auth::check() && auth()->user()->id==$comment->user_id)
                           {{-- <button class="btn btn-gradient-danger  btn-fw delete"
                                    style="padding: 3px"
                                    id="{{$comment->id}}">
                                حذف <i class="mdi mdi-delete">  </i>
                            </button>--}}
                                <a  class="btn btn-danger px-sm-1  radius-30" onclick="return confirm('{{trans('main.Are you sure you want to Unassign this agent?')}}')" href="{{ route('comments.destroy', $comment->id) }}" >حذف</a>
                            @endif
                        </div>

                    </li>
                        @endforeach
                    @endif
                    @if(Auth::check())
                    <li class="post-comment">
                        <div class="comet-avatar">
                            <img src="{{url('/')}}/site/images/resources/comet-2.jpg" alt="">
                        </div>
                        <div class="post-comt-box">
                            <form action="{{route('comments.store')}}" method="post">
                                @csrf
                                <textarea name="comment" rows="3" placeholder="{{trans('main.Post_your_comment')}}"></textarea>
                                      <input type="hidden" name="post_id" value="{{$post->id}}">
                                      <br>

                                <div class="friend-name" style="margin-top: 5px ">
                                    <button class="left btn  btn-outline-dark btn-sm" type="submit">{{trans(('main.Create'))}}</button>
                                </div>
                            </form>
                        </div>
                    </li>
                           @endif
                </ul>
            </div>
        </div>
    </div>
        @endforeach
    @endif




@endsection
@section('js')
    <script src="{{asset('admin/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('admin/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            //---------------end datatable--------------
            //---------------Delete--------------
            $(document).on('click', '.delete', function () {
                var id = $(this).attr('id');
                       alert('hhh');
                swal({
                    title: "تحذير",
                    text: "هل تريد حذف العنصر؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "حذف",
                    cancelButtonText: "الغاء",
                    okButtonText: "تأكيد",
                    closeOnConfirm: false
                }, function () {
                    console.log(id)
                    $.ajax({
                        url: 'comments/'+id,
                        type: 'delete',
                        data: {id: id},
                        success: function (data) {
                            console.log(data)
                            if (data.error==1) {
                                swal({
                                    title: "خطأ",
                                    text: "فشل العملية !!",
                                    type: "error",
                                    confirmButtonText: "موافق"
                                });
                            } else {
                                swal({
                                    title: "بنجاح!!",
                                    text: "لقد تمت العملية بنجاح",
                                    type: "success",
                                    confirmButtonText: "موافق"
                                }, function () {
                                    location.reload();
                                });
                            }
                        }
                    });
                });
            });
            //---------------Delete--------------
        });
    </script>

@endsection
