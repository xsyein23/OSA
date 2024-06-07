<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Office of Student Affairs</title>
  <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

   @include('embed.link')
</head>
<style>
  a,
  a:hover,
  a:focus,
  a:active {
    text-decoration: none;
    color: inherit;
  }


  .content {
    /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
    padding-top: 144px;
    /* Assuming the navbar height is 70px */
  }
</style>

<body style="background-color: #fdfdfd">
  @include('embed.header')
  
    <div class="content">
        <div class="bg-image ripple" data-mdb-ripple-color="light">
      <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
      <a href="#!">
        <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
          <div class="d-flex justify-content-center align-items-center h-100 text-center">
            <h2 class="text-white mb-0">Student Organizations Unit (SOU)</h2>
          </div>
        </div>
      </a>
    </div>
        <div class="container mt-5">
            <div class="osa-tag">
                <p class="tag-info">OVERVIEW</p>
                 <p class="tag-sub mt-3">
          The Student Organizations Unit is directly involved in the operation,
          management, and supervision of all recognized student organizations in
          Central Luzon State University. It is concerned with the planning, programming,
          and identifying the existing resources that can be fully utilized by the different
          Student Organizations for the benefit of their members in particular and the
          CLSU students in general.
        </p>
        <p class="tag-sub mt-4">
          The Student Organizations Unit also organizes other trainings/symposia in
          cooperation of other units in the campus such as the Guidance Services Unit,
          University Supreme Student Council, Environmental Management Institute,
          RM- CARES, etc.
        </p>
            </div>
        </div>
        <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">OFFICIAL WEBSITE PAGE</p>
          <p class="tag-sub">Visit our official website for Student Organizations Unit (SOU)</p>
        </div>
      </div>
    </div>
    <div class="container p-4">
      <h6 class="fw-bold text-primary">clsusou.com</h6>
      <!--<a href="https://clsusou.com"><h6 class="fw-bold text-primary">clsusou.com</h6></a>-->
    </div>
    </div>
  @include('embed.footer')
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
</body>

</html>