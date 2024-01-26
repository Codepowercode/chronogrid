<div class="left-menu">
    <div class="content-logo">
        <div class="logo">
            <img alt="API Doc" title="API Doc" src="{{asset('assets/doc/images/logo.png')}}" height="32" />
            <span>API Documentation</span>
        </div>
        <button class="burger-menu-icon" id="button-menu-mobile">
            <svg width="34" height="34" viewBox="0 0 100 100"><path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path><path class="line line2" d="M 20,50 H 80"></path><path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path></svg>
        </button>
    </div>
    <div class="mobile-menu-closer"></div>
    <div class="content-menu">
        <div class="content-infos">
            <div class="info"><b>Version:</b> 1.0.3</div>
            <div class="info"><b>Last Updated:</b> 14.06.2022</div>
            <div class="info"><b>README:</b> <a href="{{route('indexBackend')}}">Back End</a></div>
            <div class="info"><b>PostMan:</b> <a href="#">Download</a></div>
        </div>
        <ul>
            <li>
                <hr>
            </li>
            <li class="scroll-to-link-js active" data-target=".user-authentication" data-show="false">
                <a style="color: #00a8e3;">Authentication</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="user-authentication custom-hidden">
                <li style="padding-top: 10px;"></li>
                <li class="scroll-to-link active" data-target="login-get-started">
                    <a style="color: #00a8e3;">Login</a>
                </li>
                <li class="scroll-to-link" data-target="login-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="login-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="login-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="logout-get-started">
                    <a style="color: #00a8e3;">Logout</a>
                </li>
                <li class="scroll-to-link" data-target="logout-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="logout-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="logout-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="register-get-started">
                    <a style="color: #00a8e3;">register</a>
                </li>
                <li class="scroll-to-link" data-target="register-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="register-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="register-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="reset-pass-mail-get-started">
                    <a style="color: #00a8e3;">Reset password email</a>
                </li>
                <li class="scroll-to-link" data-target="reset-pass-mail-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="reset-pass-mail-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="reset-pass-mail-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="reset-pass-get-started">
                    <a style="color: #00a8e3;">Reset password</a>
                </li>
                <li class="scroll-to-link" data-target="reset-pass-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="reset-pass-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="reset-pass-errors">
                    <a>Errors</a>
                </li>
                <li style="padding-bottom: 10px;"></li>
            </ul>

{{--            <li>--}}
{{--                <hr>--}}
{{--            </li>--}}

{{--            <li class="scroll-to-link active" data-target="auth-user-get-started">--}}
{{--                <a style="color: #00a8e3;">Auth User</a>--}}
{{--            </li>--}}
{{--            <li class="scroll-to-link" data-target="auth-user-get-characters">--}}
{{--                <a>method</a>--}}
{{--            </li>--}}
{{--            <li class="scroll-to-link" data-target="auth-user-response">--}}
{{--                <a>Response</a>--}}
{{--            </li>--}}
{{--            <li class="scroll-to-link" data-target="auth-user-errors">--}}
{{--                <a>Errors</a>--}}
{{--            </li>--}}

            <li>
                <hr>
            </li>

            <li class="scroll-to-link-js active" data-target=".settings" data-show="false">
                <a style="color: #00a8e3;">Settings</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="settings custom-hidden">
                <li style="padding-top: 10px;"></li>
                <li class="scroll-to-link-js active" data-target=".company" data-show="false">
                    <a style="color: #00a8e3;">Company</a>
                    <span class="custom-up-down">▽</span>
                </li>

{{--                <ul class="company custom-hidden">--}}
{{--                    <li style="padding-top: 10px;"></li>--}}
{{--                    <li class="scroll-to-link active " data-target="company-reset-password-get-started">--}}
{{--                        <a style="color: #00a8e3;">Company reset password</a>--}}
{{--                    </li>--}}
{{--                    <li class="scroll-to-link" data-target="company-reset-password-get-characters">--}}
{{--                        <a>method</a>--}}
{{--                    </li>--}}
{{--                    <li class="scroll-to-link" data-target="company-reset-password-response">--}}
{{--                        <a>Response</a>--}}
{{--                    </li>--}}
{{--                    <li class="scroll-to-link" data-target="company-reset-password-errors">--}}
{{--                        <a>Errors</a>--}}
{{--                    </li>--}}
{{--                    <li style="padding-bottom: 10px;"></li>--}}
{{--                </ul>--}}

                <li>
                    <hr>
                </li>
                <li class="scroll-to-link-js active" data-target=".user-info" data-show="false">
                    <a style="color: #00a8e3;">User Info</a>
                    <span class="custom-up-down">▽</span>
                </li>

                <ul class="user-info custom-hidden">
                    <li style="padding-top: 10px;"></li>
                    <li class="scroll-to-link active " data-target="user-info-create-get-started">
                        <a style="color: #00a8e3;">User Info Create</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-create-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-create-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-create-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="user-info-update-get-started">
                        <a style="color: #00a8e3;">User Info Update</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-update-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-update-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-update-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="user-info-delete-get-started">
                        <a style="color: #00a8e3;">User Info Delete</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-delete-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-delete-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-delete-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="user-info-show-get-started">
                        <a style="color: #00a8e3;">User Info Show</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-show-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-show-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="user-info-show-errors">
                        <a>Errors</a>
                    </li>
                    <li style="padding-bottom: 10px;"></li>
                </ul>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link-js active" data-target=".company-members" data-show="false">
                    <a style="color: #00a8e3;">Company Members</a>
                    <span class="custom-up-down">▽</span>
                </li>

                <ul class="company-members custom-hidden">
                    <li style="padding-top: 10px;"></li>
                    <li class="scroll-to-link active " data-target="get-roles-get-started">
                        <a style="color: #00a8e3;">Get Roles</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-roles-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-roles-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-roles-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="get-members-get-started">
                        <a style="color: #00a8e3;">Get Members</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-members-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-members-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-members-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="get-member-by-id-get-started">
                        <a style="color: #00a8e3;">Get Members By Id</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-member-by-id-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-member-by-id-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-member-by-id-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-members-create-get-started">
                        <a style="color: #00a8e3;">Company Members Create</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-create-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-create-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-create-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-members-update-get-started">
                        <a style="color: #00a8e3;">Company Members Update</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-update-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-update-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-update-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-members-delete-get-started">
                        <a style="color: #00a8e3;">Company Members Delete</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-delete-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-delete-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-delete-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-members-block-get-started">
                        <a style="color: #00a8e3;">Company Members block</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-block-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-block-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-members-block-errors">
                        <a>Errors</a>
                    </li>
                    <li style="padding-bottom: 10px;"></li>
                </ul>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link-js active" data-target=".role" data-show="false">
                    <a style="color: #00a8e3;">Roles</a>
                    <span class="custom-up-down">▽</span>
                </li>

                <ul class="role custom-hidden">
                    <li style="padding-top: 10px;"></li>
                    <li class="scroll-to-link active " data-target="roles-settings-get-started">
                        <a style="color: #00a8e3;">Get Roles</a>
                    </li>
                    <li class="scroll-to-link" data-target="roles-settings-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="roles-settings-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="roles-settings-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="get-role-by-id-get-started">
                        <a style="color: #00a8e3;">Get Roles By Id</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-role-by-id-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-role-by-id-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-role-by-id-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="get-permissions-get-started">
                        <a style="color: #00a8e3;">Get Permissions</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-permissions-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-permissions-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-permissions-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="role-create-get-started">
                        <a style="color: #00a8e3;">Role Create</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-create-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-create-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-create-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="role-update-get-started">
                        <a style="color: #00a8e3;">Role Update</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-update-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-update-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-update-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="role-delete-get-started">
                        <a style="color: #00a8e3;">Role Delete</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-delete-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-delete-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="role-delete-errors">
                        <a>Errors</a>
                    </li>
                    <li style="padding-bottom: 10px;"></li>
                </ul>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link-js active" data-target=".product-auction" data-show="false">
                    <a style="color: #00a8e3;">Product/Auction</a>
                    <span class="custom-up-down">▽</span>
                </li>

                <ul class="product-auction custom-hidden">
                    <li style="padding-top: 10px;"></li>
                    <li class="scroll-to-link active " data-target="company-product-list-get-started">
                        <a style="color: #00a8e3;">Product list</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-product-list-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-product-list-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-product-list-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-auctions-bidded-list-get-started">
                        <a style="color: #00a8e3;">Bidded list</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-auctions-bidded-list-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-auctions-bidded-list-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-auctions-bidded-list-errors">
                        <a>Errors</a>
                    </li>
                    <li style="padding-bottom: 10px;"></li>
                </ul>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link-js active" data-target=".order-to-in" data-show="false">
                    <a style="color: #00a8e3;">Order to/in</a>
                    <span class="custom-up-down">▽</span>
                </li>

                <ul class="order-to-in custom-hidden">
                    <li style="padding-top: 10px;"></li>
                    <li class="scroll-to-link active " data-target="company-order-buy-to-get-started">
                        <a style="color: #00a8e3;">Order to (active)</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-buy-to-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-buy-to-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-buy-to-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-order-buy-in-get-started">
                        <a style="color: #00a8e3;">Order in (active)</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-buy-in-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-buy-in-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-buy-in-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="company-order-history-to-get-started">
                        <a style="color: #00a8e3;">Order to history (finished)</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-history-to-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-history-to-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-history-to-errors">
                        <a>Errors</a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="scroll-to-link active " data-target="company-order-history-in-get-started">
                        <a style="color: #00a8e3;">Order in history (finished)</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-history-in-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-history-in-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="company-order-history-in-errors">
                        <a>Errors</a>
                    </li>

                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="add-track-number-get-started">
                        <a style="color: #00a8e3;">Add track number</a>
                    </li>
                    <li class="scroll-to-link" data-target="add-track-number-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="add-track-number-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="add-track-number-errors">
                        <a>Errors</a>
                    </li>

                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="order-cancel-get-started">
                        <a style="color: #00a8e3;">Order cancel</a>
                    </li>
                    <li class="scroll-to-link" data-target="order-cancel-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="order-cancel-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="order-cancel-errors">
                        <a>Errors</a>
                    </li>

                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="get-order-status-get-started">
                        <a style="color: #00a8e3;">Get Order Status</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-order-status-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-order-status-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="get-order-status-errors">
                        <a>Errors</a>
                    </li>

                    <li>
                        <hr>
                    </li>

                    <li class="scroll-to-link active " data-target="change-order-status-get-started">
                        <a style="color: #00a8e3;">Change Order status</a>
                    </li>
                    <li class="scroll-to-link" data-target="change-order-status-get-characters">
                        <a>method</a>
                    </li>
                    <li class="scroll-to-link" data-target="change-order-status-response">
                        <a>Response</a>
                    </li>
                    <li class="scroll-to-link" data-target="change-order-status-errors">
                        <a>Errors</a>
                    </li>

                    <li style="padding-bottom: 10px;"></li>
                </ul>

                <li style="padding-bottom: 10px;"></li>
            </ul>

            <li>
                <hr>
            </li>

            <li class="scroll-to-link-js active" data-target=".subscription" data-show="false">
                <a style="color: #00a8e3;">Subscription</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="subscription custom-hidden">
                <li style="padding-top: 10px;"></li>

                <li class="scroll-to-link active" data-target="subscription-get-started">
                    <a style="color: #00a8e3;">Subscription</a>
                </li>
                <li class="scroll-to-link" data-target="subscription-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="subscription-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="subscription-errors">
                    <a>Errors</a>
                </li>
                <li style="padding-bottom: 10px;"></li>
            </ul>

            <li>
                <hr>
            </li>


            <li class="scroll-to-link-js active" data-target=".user-product" data-show="false">
                <a style="color: #00a8e3;">Products</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="user-product custom-hidden">
                <li style="padding-top: 10px;"></li>
                <li class="scroll-to-link active" data-target="products-get-started">
                    <a style="color: #00a8e3;">Products</a>
                </li>
                <li class="scroll-to-link" data-target="products-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="products-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="products-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-get-started">
                    <a style="color: #00a8e3;">Product</a>
                </li>
                <li class="scroll-to-link" data-target="product-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="products-filter-get-started">
                    <a style="color: #00a8e3;">Products filter</a>
                </li>
                <li class="scroll-to-link" data-target="products-filter-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="products-filter-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="products-filter-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="products-filter-type-get-started">
                    <a style="color: #00a8e3;">Products filter type</a>
                </li>
                <li class="scroll-to-link" data-target="products-filter-type-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="products-filter-type-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="products-filter-type-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-create-csv-file-get-started">
                    <a style="color: #00a8e3;">Product create Excel file</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-csv-file-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-csv-file-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-csv-file-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-create-get-started">
                    <a style="color: #00a8e3;">Product create</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-errors">
                    <a>Errors</a>
                </li>


                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-update-get-started">
                    <a style="color: #00a8e3;">Product update</a>
                </li>
                <li class="scroll-to-link" data-target="product-update-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-update-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-update-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-delete-get-started">
                    <a style="color: #00a8e3;">Product delete</a>
                </li>
                <li class="scroll-to-link" data-target="product-delete-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-delete-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-delete-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-delete-one-image-get-started">
                    <a style="color: #00a8e3;">Product delete one image</a>
                </li>
                <li class="scroll-to-link" data-target="product-delete-one-image-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-delete-one-image-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-delete-one-image-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-create-selects-get-started">
                    <a style="color: #00a8e3;">Product selects</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-selects-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-selects-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-create-selects-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="product-search-list-model-get-started">
                    <a style="color: #00a8e3;">product search list model</a>
                </li>
                <li class="scroll-to-link" data-target="product-search-list-model-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="product-search-list-model-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="product-search-list-model-errors">
                    <a>Errors</a>
                </li>
                <li style="padding-bottom: 10px;"></li>
            </ul>

            <li>
                <hr>
            </li>

            <li class="scroll-to-link-js active" data-target=".auction" data-show="false">
                <a style="color: #00a8e3;">Auction</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="auction custom-hidden">
                <li style="padding-top: 10px;"></li>
                <li class="scroll-to-link active" data-target="auctions-get-started">
                    <a style="color: #00a8e3;">Get Auctions</a>
                </li>
                <li class="scroll-to-link" data-target="auctions-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="auctions-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="auctions-errors">
                    <a>Errors</a>
                </li>
                <li>
                    <hr>
                </li>
                <li class="scroll-to-link active" data-target="auction-bid-history-list-get-started">
                    <a style="color: #00a8e3;">Auction bid history list</a>
                </li>
                <li class="scroll-to-link" data-target="auction-bid-history-list-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="auction-bid-history-list-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="auction-bid-history-list-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="auction-create-bid-get-started">
                    <a style="color: #00a8e3;">Auction create bid</a>
                </li>
                <li class="scroll-to-link" data-target="auction-create-bid-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="auction-create-bid-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="auction-create-bid-errors">
                    <a>Errors</a>
                </li>
                <li style="padding-bottom: 10px;"></li>
            </ul>

            <li>
                <hr>
            </li>

            <li class="scroll-to-link-js active" data-target=".user-listing" data-show="false">
                <a style="color: #00a8e3;">Listing</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="user-listing custom-hidden">
                <li style="padding-top: 10px;"></li>
                <li class="scroll-to-link active" data-target="listings-get-started">
                    <a style="color: #00a8e3;">Listings</a>
                </li>
                <li class="scroll-to-link" data-target="listings-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="listings-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="listings-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="listing-get-started">
                    <a style="color: #00a8e3;">Listing</a>
                </li>
                <li class="scroll-to-link" data-target="listing-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="listing-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="listing-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="listings-filter-get-started">
                    <a style="color: #00a8e3;">Listings filter</a>
                </li>
                <li class="scroll-to-link" data-target="listings-filter-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="listings-filter-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="listings-filter-errors">
                    <a>Errors</a>
                </li>

                <li>
                    <hr>
                </li>

                <li class="scroll-to-link active" data-target="listings-filter-type-get-started">
                    <a style="color: #00a8e3;">Listings filter type</a>
                </li>
                <li class="scroll-to-link" data-target="listings-filter-type-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="listings-filter-type-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="listings-filter-type-errors">
                    <a>Errors</a>
                </li>

                <li style="padding-bottom: 10px;"></li>
            </ul>

            <li>
                <hr>
            </li>

            <li class="scroll-to-link-js active" data-target=".orders" data-show="false">
                <a style="color: #00a8e3;">Orders</a>
                <span class="custom-up-down">▽</span>
            </li>

            <ul class="orders custom-hidden">
                <li style="padding-top: 10px;"></li>
                <li class="scroll-to-link active " data-target="company-create-order-get-started">
                    <a style="color: #00a8e3;">Create Order</a>
                </li>
                <li class="scroll-to-link" data-target="company-create-order-get-characters">
                    <a>method</a>
                </li>
                <li class="scroll-to-link" data-target="company-create-order-response">
                    <a>Response</a>
                </li>
                <li class="scroll-to-link" data-target="company-create-order-errors">
                    <a>Errors</a>
                </li>

                <li style="padding-bottom: 10px;"></li>
            </ul>

            <li>
                <hr>
            </li>

        </ul>


    </div>
</div>



