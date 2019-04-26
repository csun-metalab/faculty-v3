<!DOCTYPE HTML>
<html lang="en">
	<head>
		@if ( config('app.google_site_id') )
		<meta name="google-site-verification" content="{{ config('app.google_site_id') }}">
		@endif
		<meta charset="utf-8">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Printer Friendly Door Sign</title>
		<link rel="icon" href="//www.csun.edu/sites/default/themes/csun/favicon.ico" type="image/x-icon" />

		{{-- STYLESHEETS --}}
		{!! HTML::style('css/app.css') !!}
	</head>
    <body>
        <div id="app">
            <div class="container">
                <div class="text-center mb-5">
                    <h1>
                        @{{name}}
                    </h1>
                    <h2>
                        @{{term}} Schedule
                    </h2>
                </div>

                <h3 class="mb-2">Class Schedule:</h3>
                <template v-if="classes.length">
                    <table class="table table-bordered mb-5">
                        <thead class="thead-light">
                            <th>Course</th>
                            <th>Days</th>
                            <th>Time</th>
                            <th>Location</th>
                        </thead>
                        <tr v-for="_class in classes">
                            <template v-for='_meeting in _class.class_meetings'>
                                <td>@{{ _class.subject }} @{{ _class.catalog_number }}</td>
                                <td>@{{ _meeting.formatted_days }}</td>
                                <td>@{{ _meeting.formatted_duration }}</td>
                                <td>@{{ _meeting.location }}</td>
                            </template>
                        </tr>
                    </table>
                </template>
                <template v-else>
                    <p class="lead mb-5"><i>@{{name}} has no class schedule this semester</i><p>
                </template>

                <h3 class="mb-2">Office Hours:</h3>
                <template v-if="office_hours.length">
                    <table class="table table-bordered mb-5">
                        <thead class="thead-light">
                            <tr>
                                <th>Description</th>
                                <th>Days</th>
                                <th>Time</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="office_hour in office_hours">
                                <td>@{{ office_hour.description ? office_hour.description : office_hour.label }}</td>
                                <td>@{{ office_hour.formatted_days }}</td>
                                <td>@{{ office_hour.duration }}</td>
                                <td>@{{ office_hour.location }}</td>
                            </tr>
                        </tbody>
                    </table>
                </template>
                <template v-else>
                    <p class="lead mb-5"><i>@{{name}} has no office hours for this semester</i><p>
                </template>

                <h3 class="mb-2">Contact:</h3>
                <div class="lead">
                    @{{email}}
                </div>
            </div>
        </div>

        {{-- SCRIPTS --}}
        {!! HTML::script('/js/manifest.js') !!}
		{!! HTML::script('/js/vendor.js') !!}
		{!! HTML::script('js/app.js') !!}

		@yield('page-specific-scripts')
		{{-- GOOGLE ANALYTICS --}}
		@if ( config('app.google_analytics_id') )
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '{{ config("app.google_analytics_id") }}', 'auto');
			ga('send', 'pageview');
		</script>
        @endif
        
        <script>
            var app = new Vue({
            el: '#app',
                data: {
                    classes: window.current_classes,
                    office_hours: window.current_office_hours,
                    name: window.person_name,
                    email: window.person_email,
                    term: window.term
                }
            });

            console.log(window.current_classes)
            // console.log(window.current_office_hours)
            // console.log(window.person_name)
            // console.log(window.person_email)
            // console.log(window.term)
        </script>
    </body>
</html>


