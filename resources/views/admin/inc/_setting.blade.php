<div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
<div id="theme-settings" class="settings-panel">
    <i class="settings-close mdi mdi-close"></i>
    <p class="settings-heading"> لون القائمة الجانبية</p>
    <div class="sidebar-bg-options {{admin()->user()->slider_theme=='bg-dark'?'':'selected'}}" id="sidebar-default-theme">
        <div class="img-ss rounded-circle bg-light border mr-3"></div>العادى
    </div>
    <div class="sidebar-bg-options {{admin()->user()->slider_theme=='bg-dark'?'selected':''}}" id="sidebar-dark-theme">
        <div class="img-ss rounded-circle bg-dark border mr-3"></div>الاسود
    </div>
    <p class="settings-heading mt-2">لون القائمة الرئيسة</p>
    <div class="color-tiles mx-0 px-4">
        <div class="tiles primary"></div>
        <div class="tiles success"></div>
        <div class="tiles warning"></div>
        <div class="tiles danger"></div>
        <div class="tiles info"></div>
        <div class="tiles dark"></div>
        <div class="tiles default light"></div>
    </div>
</div>