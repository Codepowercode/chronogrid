<div class="content-page">
    <div class="content">
        <div class="overflow-hidden content-section" id="login-get-started">
            <h1>login</h1>
            <p>
                Login API options
            </p>
        </div>
        <div class="overflow-hidden content-section" id="login-get-characters">
            <h2><span class="request-method">post</span> method</h2>
            <p>
                <code class="higlighted break-word">https://app.chronogrid.com/api/login</code>
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
                    <td>email</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter email</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>String</td>
                    <td><span class="required-col">required</span></td>
                    <td>Enter password</td>
                </tr>
                </tbody>
            </table>
        </div>





        <div class="overflow-hidden content-section" id="login-response">
            <h2>Response Success <span class="success-response">200</span></h2>
            <pre><code class="json" style="border:1px solid grey">
    {
        "user": {
            "id": 1,
            "name": "admin",
            "email": "admin@gmail.com",
            "email_verified_at": null,
            "reset_password_code": null,
            "company": "0",
            "company_id": null,
            "blocked_subscription": "0",
            "login_blocked": "0",
            "blocked": "0",
            "created_at": "2022-05-25T13:27:55.000000Z",
            "updated_at": "2022-05-25T13:27:55.000000Z"
        },
        "message": "Login successfully",
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBwLmNocm9ub2dyaWQuY29tXC9hcGlcL2xvZ2luIiwiaWF0IjoxNjUzODk4MTExLCJleHAiOjE2NTQ1MDI5MTEsIm5iZiI6MTY1Mzg5ODExMSwianRpIjoiU0JPbUtnbEMzbFhKRzlTRyIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kezQXVBJf-kiegVENaUdRtUYi2Uvxo7oa7vUjaOu9sc",
        "token_type": "bearer",
        "expires_in": 604800
    }
                </code></pre>
        </div>

        <div class="overflow-hidden content-section" id="login-errors">
            <h2>Errors</h2>
            <p>
                Blocked Subscription
            </p>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>status</td>
                    <td>401</td>
                    <td>boolean</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>message</td>
                    <td>401</td>
                    <td>string</td>
                    <td>Subscription time, please buy a subscription</td>
                </tr>

                </tbody>
            </table>
            <p>
                Account blocked
            </p>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>status</td>
                    <td>401</td>
                    <td>boolean</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>message</td>
                    <td>401</td>
                    <td>string</td>
                    <td>Account blocked, please waiting access with administrator</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
