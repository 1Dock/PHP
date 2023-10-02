<?php
    class Layout
    {
        public function render($content = '')
        {
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>sysBooking</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
                  rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
                  crossorigin="anonymous">
        </head>
        <body>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">sysBooking</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/booking.php">Booking List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/profile.php">Profile passenger</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/schedule">Schedule</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php $this->content($content); ?>
        </body>
        </html>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
                crossorigin="anonymous"></script>
<?php
        }
    protected function content($content = '') {
        echo $content;
    }
    }
?>