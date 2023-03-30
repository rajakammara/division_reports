<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="col">
      <div class="row">
        <div class="fs-5 text-center">APSEVA (Revenue & CS) Service wise PBSLA</div>
        <table class="table table-bordered table-sm">
          <thead style=" font-size: 9pt;" class="verticle-align-middle text-center">
            <th>
              Service
            </th>
            @foreach($columnHeadings as $heading)
            <th>
              {{ucfirst(strtolower($heading))}}
            </th>
            @endforeach
            <th>Total</th>
          </thead>
          <tbody style=" font-size: 9pt;">
            @foreach($apseva_abstract as $item)
            <tr>
              <td class="fw-bold">
                {{$item->service_name}}
              </td>

              @foreach($columnHeadings as $heading)
              <td class="text-center align-middle @if($item->$heading>0) fw-bold fs-6 @endif">
                {{$item->$heading}}
              </td>
              @endforeach
              <td class="text-center align-middle @if($item->Total>0) fw-bold fs-6 @endif">
                {{$item->Total}}
              </td>
            </tr>
            @endforeach
            @foreach($mandal_total_pivot as $item)
            <tr class="text-center align-middle @if($item->$heading>0) fw-bold fs-6 @endif">
              <td>
                {{$item->service_name}}
              </td>

              @foreach($columnHeadings as $heading)
              <td class="bg-danger text-white">
                {{$item->$heading}}
              </td>
              @endforeach
              <td class="bg-danger text-white">
                {{$item->Total}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>

</body>

</html>