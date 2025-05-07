<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ZTSHOP - Installation</title>

    <link rel="shortcut icon" href="{{ asset('build/assets/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @routes

    @vite([
    'resources/sass/install/app.scss',
    'resources/js/install/app.js'
    ])
</head>

<body class="ltr">
    <div x-data="App({
                requirementSatisfied: {{ $requirement->satisfied() ? 'true' : 'false' }},
                permissionProvided: {{ $permission->provided() ? 'true' : 'false' }}
            })" class="wrapper">
        <div class="installer-box d-flex flex-column flex-md-row">
            <aside class="installer-left-sidebar d-flex flex-column justify-content-between">
                <div class="logo d-flex justify-content-center">
                    <svg version="1.1" viewBox="0 0 2000 2000" width="500" height="500"
                        xmlns="http://www.w3.org/2000/svg">
                        <path transform="translate(1449,777)"
                            d="m0 0h391l43 1 4 1 1 6v297l-1 56-2 35-3 41-8 66-8 42-8 32-15 53-8 24-15 37-13 30-12 23-12 22-12 21-22 32-14 19-10 13-8 10-11 13-7 7-7 8-15 16-13 13-8 7-12 11-13 12-14 11-21 16-29 20-11 7-9 6-16 8-12 7-8 4-11 7-21 10-11 4-15 7-27 11-17 6-34 11-32 9-36 8-35 7-34 5-55 6-68 3-57 1h-930l-2-2-1-4v-435l2-2 83-1 700 1h187l54-2 34-3 35-5 31-6 31-9 25-9 35-17 11-7 13-10 11-11 13-17 9-16 11-24 5-12 10-31 8-37 3-25 4-36 2-33 1-36 1-317 1-14z"
                            fill="#abbbce" />
                        <path transform="translate(932,103)"
                            d="m0 0h951l4 1 1 8v431l-1 1-34 1-947 1-55 2-43 4-33 5-30 7-19 6-18 6-32 16-19 12-10 8-11 11-12 17-11 19-11 23-9 27-6 21-7 35-5 35-2 18-1 17-1 385-2 2-4 1h-428l-10-1-2-5v-283l1-47 2-51 4-56 7-53 5-28 9-43 10-36 9-29 9-25 6-15 6-16 17-37 10-20 13-23 9-16 16-25 13-18 14-19 11-14 9-10 1-2h2l2-4 15-16 7-8 20-20 8-7 7-7 8-7 10-9 14-11 16-12 16-11 14-10 11-7 13-8 30-16 13-8 28-13 28-12 34-13 41-13 25-7 36-8 36-7 25-4 56-6 33-2z"
                            fill="#abbbce" />
                        <path transform="translate(813,778)"
                            d="m0 0h303l112 1 1 1 1 161v38l-1 241-7 2h-435l-1-1-1-19v-413l1-10z" fill="#0068e1" />
                    </svg>
                </div>

                <ul class="step-list list-inline">
                    <li class="step-list-item d-flex position-relative active" :class="{
                                'active': step === 1,
                                'complete': step >= 2
                            }">
                        <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                            <template x-if="step > 1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" />
                                </svg>
                            </template>

                            <template x-if="!(step > 1)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>circle</title>
                                    <path
                                        d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                </svg>
                            </template>
                        </div>

                        <div>
                            <label class="title">Requirements</label>

                            <span class="excerpt d-block">Check system requirements</span>
                        </div>
                    </li>

                    <li class="step-list-item d-flex position-relative" :class="{
                                'active': step === 2,
                                'complete': step >= 3
                            }">
                        <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                            <template x-if="step > 2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" />
                                </svg>
                            </template>

                            <template x-if="!(step > 2)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>circle</title>
                                    <path
                                        d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                </svg>
                            </template>
                        </div>

                        <div>
                            <label class="title">Permissions</label>

                            <span class="excerpt d-block">Obtain necessary permissions</span>
                        </div>
                    </li>

                    <li class="step-list-item d-flex position-relative" :class="{
                                'active': step === 3 && !appInstalled,
                                'complete': appInstalled
                            }">
                        <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                            <template x-if="appInstalled">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" />
                                </svg>
                            </template>

                            <template x-if="!(appInstalled)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>circle</title>
                                    <path
                                        d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                </svg>
                            </template>
                        </div>

                        <div>
                            <label class="title">Configuration</label>

                            <span class="excerpt d-block">Configure the application</span>
                        </div>
                    </li>

                    <li class="step-list-item d-flex position-relative" :class="{
                                'complete': appInstalled
                            }">
                        <div class="icon d-flex justify-content-center align-items-center rounded-circle">
                            <template x-if="appInstalled">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" />
                                </svg>
                            </template>

                            <template x-if="!(appInstalled)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <title>circle</title>
                                    <path
                                        d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                </svg>
                            </template>
                        </div>

                        <div>
                            <label class="title">Complete</label>

                            <span class="excerpt d-block">Installation successful</span>
                        </div>
                    </li>
                </ul>

                <span class="app-version">
                    {{ fleetcart_version() }}
                </span>
            </aside>

            <section class="installer-main-content flex-grow-1 overflow-hidden">
                @yield('content')
            </section>
        </div>
    </div>

    @stack('scripts')
</body>

</html>