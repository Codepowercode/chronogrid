<div class="content-page">
    <hr>
    <div class="content">
        <div class="overflow-hidden content-section" id="reset-pass-get-started">
            <h1>Reset password</h1>
            <p>
                Reset password API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="reset-pass-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/reset/password</code>
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
                    <td>code</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Code in email</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter password</td>
                </tr>
                <tr>
                    <td>confirm_password</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter confirm password</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="reset-pass-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "status": true,
        "message": "Successfully reset password",
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="reset-pass-errors">
            <h2>Errors</h2>
            <p>
                Equal password
            </p>
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
                    <td>Confirm password dont equal password</td>
                </tr>

                </tbody>
            </table>
            <p>
                Not found such a user
            </p>
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
                    <td>Don't not exist this email</td>
                </tr>

                </tbody>
            </table>
            <p>
                Error code
            </p>
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
                    <td>Error reset password code</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
