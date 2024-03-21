<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/loader.js') }}"></script>
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />

<link rel="stylesheet" href="{{ asset('plugins/font-icons/fontawesome/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/elements/avatar.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}">

{{--  --}}
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 

<link rel="stylesheet" href="{{ asset('assets/css/widgets/modules-widgets.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">

<link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
    aside {
        display: none!important;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #FFF;
        background-color: #3B3F5C;
        border-color: #3B3F5C;
    }

    @media ( max-width: 480px ) {
        .mtmobile {
            margin-bottom: 20px!important;
        }
        .mbmobile {
            margin-bottom: 10px!important;
        }
        .hideonsm {
            display: none!important;
        }
        .inblock {
            display: block;
        }
    }

    .sidebar-theme #compactSidebar {
        background: #5356FF!important;
    }

    .header-container .sidebarCollapse {
        color: #5356FF!important;
    }

</style>

@livewireStyles