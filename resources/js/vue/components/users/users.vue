<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex">
        <div>
          <button
            type="button"
            @click="$router.go(-1)"
            class="btn btn-success mt-1"
          >
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Back
          </button>
        </div>

        <nav class="breadcrumb ml-3">
          <a class="breadcrumb-item" @click="$router.push('/')">Home</a>
          <span class="breadcrumb-item active">Users</span>
        </nav>
      </div>
      <!-- <div class="d-flex justify-content-center">
        <img class="imgs-fluid" style="height: 100px;" src="img/comingsoon.png" alt="" />
      </div>
      <div class="d-flex justify-content-center">
        <h5 class="text-secondary font-weight-bold">Coming soon...</h5>
      </div>
      <hr>       -->
    </div>
    <!-- <div class="col-12">
      <table class="table hover multiple-select-row data-table-export nowrap">
        <thead>
          <tr>
            <th class="table-plus datatable-nosort">Name</th>
            <th>Age</th>
            <th>Office</th>
            <th>Address</th>
            <th>Start Date</th>
            <th>Salart</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="table-plus">Gloria F. Mead</td>
            <td>25</td>
            <td>Sagittarius</td>
            <td>2829 Trainer Avenue Peoria, IL 61602</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Gemini</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>20</td>
            <td>Gemini</td>
            <td>2829 Trainer Avenue Peoria, IL 61602</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Sagittarius</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>25</td>
            <td>Gemini</td>
            <td>2829 Trainer Avenue Peoria, IL 61602</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>20</td>
            <td>Sagittarius</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>18</td>
            <td>Gemini</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Sagittarius</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Sagittarius</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Gemini</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Gemini</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td class="table-plus">Andrea J. Cagle</td>
            <td>30</td>
            <td>Gemini</td>
            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
            <td>29-03-2018</td>
            <td>$162,700</td>
          </tr>
        </tbody>
      </table>
    </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>