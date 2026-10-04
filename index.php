<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexQ</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="w-full min-h-screen bg-[#0a0a0a] text-white flex flex-col">

    <main class="flex flex-1 max-w-[1440px] mx-auto justify-evenly">
        <section class="max-w-md p-8 justify-center flex flex-col">
            <img src="public/png/tip-logo.png" alt="NexQ Logo" class="size-32">
            <h1 class="text-5xl font-bold">Nex<span class="text-[#fdd201]">Q</span></h1>
            <h2 class="font-semibold text-2xl">Queue Notification System</h2>
            <p class="text-xl">Student Accounting Office</p>
            <br>
            <br>
            <h2 class="text-[#fdd201] font-semibold text-3xl">Smart Queue. Less Wait. Better Experience.</h2>
            <p class="text-sm">NexQ helps the Student Accounting Office manage lines efficiently and provide a better service experience.</p>
        </section>

        <section class="flex flex-col justify-center">
            <div class="border-2 border-[#fdd201] rounded-xl p-8">
                <div class="flex items-center gap-5">
                    <div class="border-2 border-[#fdd201] rounded-full flex justify-center items-center size-16">
                        <svg width="35px" height="35px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#fdd201" />
                            <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#fdd201" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-5xl font-bold">Welcome!</h1>
                        <p class="text-2xl">Please sign in to continue.</p>
                    </div>
                </div>

                <form id="loginForm" action="app/controller/userController.php" method="post" class="flex flex-col gap-6 mt-2">
                    <div class="flex flex-col">
                        <label for="username">Username</label>
                        <div class="relative w-full flex items-center">
                            <svg
                                class="absolute left-3 w-5 h-5 text-white pointer-events-none"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.54 0 4.847.68 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input id="username" type="text" name="username" placeholder="Enter your username" class="border-2 border-[#fdd201] rounded-lg w-full pl-10 pr-3 py-3 rounded-lg bg-transparent text-white placeholder-white focus:outline-none focus:border-[#fed201] autofill:border-black [&:-webkit-autofill:focus]:border-black">
                        </div>

                        <p id="usernameError" class="hidden text-red-500 text-sm mt-1">
                            Username is required
                        </p>
                    </div>

                    <div class="flex flex-col">
                        <label for="password">Password</label>

                        <div class="relative w-full flex items-center">
                            <!-- Lock Icon -->
                            <svg
                                class="absolute left-3 w-5 h-5 text-white pointer-events-none"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 10V7a4 4 0 00-8 0v3m-2 0h12a2 2 0 012 2v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7a2 2 0 012-2z" />
                            </svg>

                            <!-- Password Input -->
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                class="border-2 border-[#fdd201] rounded-lg w-full pl-10 pr-10 py-3 bg-transparent text-white placeholder-white focus:outline-none focus:border-[#fed201]">

                            <!-- Eye Button -->
                            <!-- Eye Button -->
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 text-white">

                                <svg
                                    id="eyeIcon"
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <!-- Eye with slash - initial state -->
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18M10.584 10.587a2 2 0 002.829 2.828M9.88 4.09A9.77 9.77 0 0112 4c4.477 0 8.268 2.943 9.542 7a10.08 10.08 0 01-4.132 5.411M6.228 6.228C4.54 7.45 3.245 9.124 2.458 12c1.274 4.057 5.065 7 9.542 7 1.02 0 2.005-.16 2.923-.46" />
                                </svg>
                            </button>
                        </div>

                        <p id="passwordError" class="hidden text-red-500 text-sm mt-1">
                            Password is required
                        </p>
                    </div>

                    <div class="flex justify-between">
                        <div>
                            <input type="checkbox" name="rememberme" id="rememberme">
                            <label for="rememberme">Remember me</label>
                        </div>

                        <div>
                            <a href="#" class="text-[#fdd201]">Forgot password?</a>
                        </div>
                    </div>
                    <button
                        id="loginButton"
                        type="submit"
                        class="bg-[#fdd201] p-3 text-black font-bold rounded-lg disabled:opacity-70 disabled:cursor-not-allowed">

                        <div class="flex justify-center items-center gap-1">
                            <!-- Login Icon -->
                            <svg
                                id="loginIcon"
                                width="25px"
                                height="25px"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">

                                <path
                                    d="M2.00098 11.999L16.001 11.999M16.001 11.999L12.501 8.99902M16.001 11.999L12.501 14.999"
                                    stroke="#000000"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />

                                <path
                                    d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17"
                                    stroke="#000000"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>

                            <h1 id="loginText" class="text-lg">Log in</h1>

                            <!-- Loading Spinner -->
                            <svg
                                id="loginSpinner"
                                class="hidden animate-spin w-5 h-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                    stroke="currentColor"
                                    stroke-width="3"
                                    class="opacity-25" />

                                <path
                                    d="M21 12a9 9 0 0 0-9-9"
                                    stroke="currentColor"
                                    stroke-width="3"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer class="md:flex md:justify-between bg-[#fed201] px-8 md:pt-3 md:pb-2 text-black">
        <div class="flex gap-1 md:gap-5 md:flex-row flex-col justify-center items-center">
            <img src="public/png/tip-logo.png" alt="Tip Logo" class="size-24">

            <div class="flex flex-col justify-center font-semibold">
                <h2 class="text-center md:text-start">
                    Technological Institute of the Philippines
                </h2>

                <h2 class="text-center md:text-start">
                    Student Accounting Office
                </h2>
            </div>
        </div>

        <div class="lg:flex flex-col justify-center items-end hidden">
            <h1 class="text-5xl font-bold">Nex<span class="text-[#36454F]">Q</span></h1>
            <p class="font-semibold">Smart Queue. Less Wait. Better Experience.</p>
        </div>
    </footer>

    <div
        id="errorModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">

        <div
            id="errorModalContent"
            class="relative bg-white rounded-xl shadow-xl w-full max-w-sm p-6 text-center">

            <!-- Close X Button -->
            <button
                type="button"
                onclick="closeErrorModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 transition">

                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>


            <!-- Error Icon -->
            <div class="flex justify-center mb-4">
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-yellow-100">

                    <svg
                        class="w-8 h-8 text-[#fdd201]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </div>
            </div>


            <!-- Title -->
            <h2 class="text-xl font-bold text-gray-800">
                Login Failed
            </h2>


            <!-- Message -->
            <p class="text-gray-600 mt-2">
                Invalid username or password.
            </p>


            <!-- Try Again -->
            <button
                type="button"
                onclick="closeErrorModal()"
                class="mt-5 w-full bg-[#fdd201] text-black font-bold py-3 rounded-lg hover:bg-[#e8c000] transition">

                Try Again

            </button>

        </div>
    </div>

    <script>
        <?php include 'js/view-password.js'; ?>
        <?php include 'js/log-in-button-spinner.js'; ?>
        <?php include 'js/remove-error.js'; ?>
        <?php include 'js/invalid-credentials-error.js'; ?>
    </script>

</body>

</html>