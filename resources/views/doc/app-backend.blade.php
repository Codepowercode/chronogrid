<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>API - Documentation</title>
    <meta name="description" content="">
    <meta name="author" content="ticlekiwi">

    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{asset('assets/doc/css/hightlightjs-dark.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/doc/css/style.css')}}" media="all">
    <script>
        hljs.initHighlightingOnLoad();
    </script>
</head>

<body class="one-content-column-version">

@include('doc.componentsBackEnd.left-menu-backend')

{{-- todo  --}}
@include('doc.componentsBackEnd.items.copy')









<style>
    .github-corner:hover .octo-arm {
        animation: octocat-wave 560ms ease-in-out
    }

    @keyframes octocat-wave {
        0%,
        100% {
            transform: rotate(0)
        }
        20%,
        60% {
            transform: rotate(-25deg)
        }
        40%,
        80% {
            transform: rotate(10deg)
        }
    }
    .request-method{
        background-color: white;
        padding: 5px;
        border-radius: 5px;
        color: black;
    }
    .break-word{
        background: #ffffff3b;
        padding: 7px;
    }
    .nullable-col{
        background: #00000070;
        padding: 4px;
        border-radius: 3px;
        color: white;
        margin-left: 2px;
    }
    .required-col{
        background: #ff000047;
        padding: 4px;
        border-radius: 3px;
        color: white;
        margin-left: 2px;
    }
    .success-response{
        background-color: #ffffff1a;
        padding: 5px;
        border-radius: 5px;
        color: #33ff009e;
    }



    @media (max-width:500px) {
        .github-corner:hover .octo-arm {
            animation: none
        }
        .github-corner .octo-arm {
            animation: octocat-wave 560ms ease-in-out
        }
    }
    @media only screen and (max-width:680px){ .github-corner > svg { right: auto!important; left: 0!important; transform: rotate(270deg)!important;}}
</style>
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: rgba(194, 194, 194, 1);
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .custom-hidden{
        display:none;
        padding-left: 30px !important;
        background: #00272e;
    }
    .custom-show{
        display:block;
    }
    .custom-up-down{
        position: absolute;
        top: 21px;
        right: 19px;
        color: #2db6e7;
    }
    .scroll-to-link-js{
        position: relative;
        cursor: pointer;

    }
    .content-menu ul li:hover, .content-menu ul li.active{
        border-radius: 10px 0px 0px 10px;
    }
</style>
<!-- END Github Corner Ribbon - to remove -->
<script src="{{asset('assets/doc/js/script.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    $( document ).ready(function() {
        $(document).on('click', '.scroll-to-link-js', function () {
            let className = $(this).attr('data-target')
            if($(this).attr('data-show') == 'false'){
                $(this).attr('data-show', 'true')
                $(this).attr('style', 'border-bottom: 1px solid #0dace4;')
                $(className).attr('style','display:block;');
                $(this).find('.custom-up-down').html('△');
            }else{
                $(this).attr('style', ' ')
                $(this).attr('data-show', 'false')
                $(className).attr('style','display:none;');
                $(this).find('.custom-up-down').html('▽');
            }


        })
    });
</script>
</body>

</html>
