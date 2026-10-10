<footer class="flex flex-col lg:flex-row justify-between bg-[#FED201] px-5 py-2">
    <div class="flex items-center lg:flex-row flex-col">
        <img src="../public/png/tip-logo.png" alt="Tip Logo" class="lg:size-24 size-20">

        <div class="flex flex-col text-black lg:items-start items-center justify-center lg:justify-start">
            <p class="lg:text-start text-center">Technological Institute of the Philippines</p>
            <p>Student Accounting Office</p>
        </div>
    </div>

    <!--date and time-->
    <div class="lg:flex items-center gap-10 hidden">
        <div class="flex items-center gap-1">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 9H21M7 3V5M17 3V5M6 13H8M6 17H8M11 13H13M11 17H13M16 13H18M16 17H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div id="current-date-superadmin" class="text-black"></div>
        </div>

        <div class="flex items-center gap-1">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 8V12L15 15" stroke="#000000" stroke-width="2" stroke-linecap="round" />
                <circle cx="12" cy="12" r="9" stroke="#000000" stroke-width="2" />
            </svg>
            <div id="current-time-superadmin" class="text-black"></div>
        </div>
    </div>
</footer>