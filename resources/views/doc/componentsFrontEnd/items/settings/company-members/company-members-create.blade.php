<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="company-members-create-get-started">
            <h1>Create member info</h1>
            <p>
                Create member information API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="company-members-create-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/settings/members/create</code>
            </p>
            <br>
            <h4>QUERY PARAMETERS</h4>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Importance</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>access_token</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Your API access key. (header)</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Name member</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Email member</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Password</td>
                </tr>
                <tr>
                    <td>password_confirmation</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Password Confirmation</td>
                </tr>
                <tr>
                    <td>role</td>
                    <td>Array</td>
                    <td><span class="required-col">required</span></td>
                    <td>Roles</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="company-members-create-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
      "status": true,
      "message": "Successfully reset password",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="company-members-create-errors">
            <h2>Errors</h2>
{{--            <p>--}}
{{--                The Westeros API uses the following error codes:--}}
{{--            </p>--}}
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>status</td>
                    <td>boolean</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>message</td>
                    <td>string</td>
                    <td>error message</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
