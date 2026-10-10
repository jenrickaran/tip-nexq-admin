<header class="lg:flex justify-between hidden">
    <div class="flex gap-2">
        <img src="../public/png/tip-logo.png" alt="Tip Logo" class="size-24">

        <div class="flex flex-col justify-center">
            <h1 class="text-5xl font-semibold">Nex<span class="text-[#fdd201]">Q</span></h1>
            <h2>Student Accounting Office</h2>
        </div>
    </div>

    <!--dropdown menu-->

    <form action="../app/controller/logoutController.php" class="items-center flex">
        <button type="submit" class="cursor-pointer">
            <div class="flex items-center gap-2">
                <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.04401 9.53165C7.33763 9.23949 7.33881 8.76462 7.04665 8.47099C6.75449 8.17737 6.27962 8.17619 5.98599 8.46835L7.04401 9.53165ZM2.97099 11.4683C2.67737 11.7605 2.67619 12.2354 2.96835 12.529C3.26051 12.8226 3.73538 12.8238 4.02901 12.5317L2.97099 11.4683ZM4.02901 11.4683C3.73538 11.1762 3.26051 11.1774 2.96835 11.471C2.67619 11.7646 2.67737 12.2395 2.97099 12.5317L4.02901 11.4683ZM5.98599 15.5317C6.27962 15.8238 6.75449 15.8226 7.04665 15.529C7.33881 15.2354 7.33763 14.7605 7.04401 14.4683L5.98599 15.5317ZM3.5 11.25C3.08579 11.25 2.75 11.5858 2.75 12C2.75 12.4142 3.08579 12.75 3.5 12.75V11.25ZM17.5 12.75C17.9142 12.75 18.25 12.4142 18.25 12C18.25 11.5858 17.9142 11.25 17.5 11.25V12.75ZM5.98599 8.46835L2.97099 11.4683L4.02901 12.5317L7.04401 9.53165L5.98599 8.46835ZM2.97099 12.5317L5.98599 15.5317L7.04401 14.4683L4.02901 11.4683L2.97099 12.5317ZM3.5 12.75L17.5 12.75V11.25L3.5 11.25V12.75Z" fill="#FFFFFF" />
                    <path d="M9.5 15C9.5 17.2091 11.2909 19 13.5 19H17.5C19.7091 19 21.5 17.2091 21.5 15V9C21.5 6.79086 19.7091 5 17.5 5H13.5C11.2909 5 9.5 6.79086 9.5 9" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h1>Logout</h1>
            </div>
        </button>
    </form>
</header>

<header class="relative lg:hidden">

    <!-- Hamburger Button -->
    <div class="p-4 flex gap-2">
        <button
            type="button"
            id="menuButton"
            aria-label="Open navigation menu"
            aria-expanded="false"
            class="cursor-pointer">

            <svg
                width="24px"
                height="24px"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
                fill="none">

                <path
                    fill="#FFFFFF"
                    fill-rule="evenodd"
                    d="M18 5a1 1 0 100-2H2a1 1 0 000 2h16zm0 4a1 1 0 100-2H2a1 1 0 100 2h16zm1 3a1 1 0 01-1 1H2a1 1 0 110-2h16a1 1 0 011 1zm-1 5a1 1 0 100-2H2a1 1 0 100 2h16z" />
            </svg>
        </button>
        <div class="flex flex-1 justify-center items-center gap-2">
            <div id="current-date-mobile-superadmin" class="text-white"></div>
            <div id="current-time-mobile-superadmin" class="text-white"></div>
        </div>
    </div>

</header>