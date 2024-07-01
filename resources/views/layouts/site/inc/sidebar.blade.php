<style>
    .sidebar {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .widget-title {
        color: #343a40;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .naves li {
        list-style: none;
        margin: 10px 0;
    }

    .naves li a {
        text-decoration: none;
        color: #495057;
        font-weight: 500;
        transition: color 0.3s;
    }

    .naves li a:hover {
        color: #007bff;
    }

    .naves li i {
        margin-right: 10px;
        color: #007bff;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    select {
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        margin-right: 10px;
    }

    .success-message {
        color: green;
        font-weight: bold;
        display: none;
        margin-top: 10px;
    }
</style>

<div class="col-lg-3">
    <aside class="sidebar static">
        <div class="widget">
            <h4 class="widget-title">{{ __('Shortcuts') }}</h4>
            <ul class="naves">
                <li>
                    <i class="ti-mouse-alt"></i>
                    <a href="{{ url('/') }}" title="{{ __('Home') }}">{{ __('Home') }}</a>
                </li>
                <li>
                    <i class="ti-files"></i>
                    <a href="{{ url('siteProfile') }}" title="{{ __('MyProfile') }}">{{ __('MyProfile') }}</a>
                </li>
                @auth
                <li>
                    <form id="status-form">
                        @csrf
                        <select id="status" name="status">
                            <option value="active">{{ __('Active') }}</option>
                            <option value="critical">{{ __('Critical') }}</option>
                            <option value="inactive">{{ __('Inactive') }}</option>
                        </select>
                        <button type="button" onclick="updateStatus()">{{ __('Update status') }}</button>
                    </form>
                    <div class="success-message" id="success-message">{{ __('Status updated successfully!') }}</div>
                    <br>
                    <form action="{{ route('users_location') }}" method="post">
                        @csrf
                        <button class="btn btn-info" type="submit"><i class="ti-map"></i> {{ __('Go to Map') }}</button>
                    </form>
                    <script src="/js/status.js"></script>
                    <script>
                        function updateStatus() {
                            document.getElementById('success-message').style.display = 'block';
                            setTimeout(() => {
                                document.getElementById('success-message').style.display = 'none';
                            }, 3000); // Hide after 3 seconds
                            var status = document.getElementById('status').value;
                            handleStatusChange(status);
                        }
                    </script>
                </li>
                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="active">{{ __('Logout') }} <i class="ti-power-off"></i></button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </aside>
</div>
