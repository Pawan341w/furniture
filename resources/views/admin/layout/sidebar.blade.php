 <!-- partial:partials/_settings-panel.html -->
        <div class="right-sidebar-toggler-wrapper">
          <div class="sidebar-toggler" id="settings-trigger"><i class="mdi mdi-palette"></i></div>
          <div class="sidebar-toggler" id="chat-toggler"><i class="mdi mdi-chat-processing"></i></div>
          <div class="sidebar-toggler"><a href="https://www.bootstrapdash.com/demo/majestic-admin-pro/docs/documentation.html" target="_blank"><i class="mdi mdi-file-document-outline"></i></a></div>
          <div class="sidebar-toggler"><a href="https://www.bootstrapdash.com/product/majestic-admin-pro/" target="_blank"><i class="mdi mdi-cart"></i></a></div>
        </div>
        <div class="theme-setting-wrapper">
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme">
              <div class="img-ss rounded-circle bg-light border me-3"></div>Light
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
              <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
          <div id="layout-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading font-weight-bold border-top-0 mb-3 ps-3 pt-0 border-bottom-0 pb-0">Template Demos </p>
            </div>
            <div class="demo-screen-wrapper">
              <a href="https://demo.bootstrapdash.com/purple/jquery/template/demo_1/" target="_blank" class="demo-thumb-image" id="theme-light-switch">
                <img src="../assets/images/screenshots/vertical-light.jpg" alt="demo image">
              </a>
              <a href="https://demo.bootstrapdash.com/purple/jquery/template/demo_2/" target="_blank" class="demo-thumb-image">
                <img src="../assets/images/screenshots/vertical-dark.jpg" alt="demo image">
              </a>
              <a href="https://demo.bootstrapdash.com/purple/jquery/template/demo_3/" target="_blank" class="demo-thumb-image" id="theme-dark-switch">
                <img src="../assets/images/screenshots/horizontal-light.jpg" alt="demo image">
              </a>
              <a href="https://demo.bootstrapdash.com/purple/jquery/template/demo_4/" target="_blank" class="demo-thumb-image">
                <img src="../assets/images/screenshots/horizontal-dark.jpg" alt="demo image">
              </a>
            </div>
          </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <ul class="nav nav-tabs" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Team review meeting at 3.00 PM </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Prepare for presentation </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Resolve all the low priority tickets due today </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked> Schedule meeting for next week </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked> Project review </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                </ul>
              </div>
              <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary me-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary me-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 ps-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pe-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="../assets/images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../assets/images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../assets/images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../assets/images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../assets/images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../assets/images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('categories.index') }}">
        <span class="menu-title">Category</span>
        <i class="mdi mdi-shape menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('products.index') }}">
        <span class="menu-title">Products</span>
        <i class="mdi mdi-view-grid menu-icon"></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('qr.mang') }}">
        <span class="menu-title">Qr Management</span>
<i class="mdi mdi-qrcode menu-icon"></i>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('users.index') }}">
        <span class="menu-title">User Management</span>
<i class="mdi mdi-account-multiple menu-icon"></i>
    </a>
</li>

            {{--<li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Page Layouts</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-view-grid menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/boxed-layout.html">Boxed</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/rtl-layout.html">RTL</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#apps" aria-expanded="false" aria-controls="apps">
                <span class="menu-title">Apps</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cart-arrow-down menu-icon"></i>
              </a>
              <div class="collapse" id="apps">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/kanban-board.html">Kanban Board</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/todo.html">Todo List</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/tickets.html">Tickets</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/apps/chats.html">Chats</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/samples/widgets.html">
                <span class="menu-title">Widgets</span>
                <i class="mdi mdi-forum menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                <span class="menu-title">Sidebar Layouts</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-playlist-play menu-icon"></i>
              </a>
              <div class="collapse" id="sidebar-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/compact-menu.html">Compact menu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/sidebar-collapsed.html">Icon menu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/sidebar-hidden.html">Sidebar Hidden</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/sidebar-hidden-overlay.html">Sidebar Overlay</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/layout/sidebar-fixed.html">Sidebar Fixed</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/accordions.html">Accordions</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/badges.html">Badges</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/modals.html">Modals</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/progress.html">Progress Bar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/pagination.html">Pagination</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/tabs.html">Tabs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/tooltips.html">Tooltip</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <span class="menu-title">Advanced UI</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cards-variant menu-icon"></i>
              </a>
              <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/dragula.html">Dragula</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/clipboard.html">Clipboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/context-menu.html">Context menu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/slider.html">Slider</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/colcade.html">Colcade</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/carousel.html">Carousel</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/loaders.html">Loaders</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/treeview.html">Tree View</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ui-features/popups.html">
                <span class="menu-title">Popups</span>
                <i class="mdi mdi-forum menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ui-features/notifications.html">
                <span class="menu-title">Notifications</span>
                <i class="mdi mdi-bell-ring menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/icons/mdi.html">Material</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/icons/flag-icons.html">Flag icons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/icons/simple-line-icon.html">Simple line icons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/icons/themify.html">Themify icons</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Forms</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/basic_elements.html">Form Elements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/advanced_elements.html">Advanced Forms</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/validation.html">Validation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/forms/wizard.html">Wizard</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/text_editor.html">
                <span class="menu-title">Text editors</span>
                <i class="mdi mdi-file-document menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/code_editor.html">
                <span class="menu-title">Code editors</span>
                <i class="mdi mdi-code-not-equal-variant menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/morris.html">Morris</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/flot-chart.html">Flot</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/google-charts.html">Google charts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/sparkline.html">Sparkline js</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/c3.html">C3 charts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/chartist.html">Chartist</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/justGage.html">JustGage</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/tables/data-table.html">Data table</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/tables/js-grid.html">Js-grid</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/tables/sortable-table.html">Sortable table</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
                <span class="menu-title">Maps</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-map-marker-radius menu-icon"></i>
              </a>
              <div class="collapse" id="maps">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/maps/google-maps.html">Google Maps</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/maps/mapael.html">Mapael</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/maps/vector-map.html">Vector map</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-lock menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/login.html"> Login </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/multi-level-login.html"> Multi Level Login </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/register.html"> Register </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-security menu-icon"></i>
              </a>
              <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">General Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/landing-page.html"> Landing Page </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/profile.html"> Profile </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/faq.html"> FAQ </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/faq-2.html"> FAQ 2 </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/news-grid.html"> News Grid </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/timeline.html"> Timeline </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/search-results.html"> Search Results </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/portfolio.html"> Portfolio </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/user-listing.html"> User Listing </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#e-commerce" aria-expanded="false" aria-controls="e-commerce">
                <span class="menu-title">E-commerce</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-shopping menu-icon"></i>
              </a>
              <div class="collapse" id="e-commerce">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/email-template.html"> Email Templates </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/invoice.html"> Invoice </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/pricing-table.html"> Pricing Table </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/product-catalogue.html"> Product Catalogue </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/project-list.html"> Project List </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/orders.html"> Orders </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/email.html">
                <span class="menu-title">E-mail</span>
                <i class="mdi mdi-email menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/calendar.html">
                <span class="menu-title">Calendar</span>
                <i class="mdi mdi-calendar-today menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/gallery.html">
                <span class="menu-title">Gallery</span>
                <i class="mdi mdi-image-filter-frames menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demo.bootstrapdash.com/purple-new/docs/documentation.html" target="_blank">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <div class="d-grid gap-2">
                  <button class="btn btn-block btn-lg btn-gradient-primary mt-4"> + Add a project </button>
                </div>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
                </div>
              </span>
            </li> --}}
          </ul>
        </nav>
