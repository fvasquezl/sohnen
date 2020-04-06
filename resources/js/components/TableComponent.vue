<template>
  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title mt-1">Amazon Merchant SKU</h3>

      <div class="card-tools"></div>
    </div>

    <div class="card-body">
      <table class="table table-striped table-bordered table-hover nowrap" id="skusTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>MerchantSKU</th>
            <th>AccountName</th>
            <th>DateAdded</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="maping in mapedSkus" :key="maping.ID">
            <td>{{maping.ID}}</td>
            <td>{{maping.SKU}}</td>
            <td>{{maping.MerchantSKU}}</td>
            <td>{{maping.AccountName}}</td>
            <td>{{maping.DateAdded}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import datatables from "datatables.net-bs4";

export default {
  data() {
    return {
      mapedSkus: []
    };
  },
  created() {
    this.getMappedSkus();
  },
  watch: {
    mapedSkus() {
      $(document).ready(function() {
        $("#skusTable").DataTable();
      });
    }
  },
  methods: {
    getMappedSkus() {
      var urlMapedSkus = "api/ams";
      axios.get(urlMapedSkus).then(response => {
        this.mapedSkus = response.data;
      });
    }
  }
};
</script>

<style>
</style>
