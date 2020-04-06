<template>
  <div>
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active"
          id="bin-tab"
          data-toggle="tab"
          href="#bin"
          role="tab"
          aria-controls="bin"
          aria-selected="true"
        >Bins</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          id="image-tab"
          data-toggle="tab"
          href="#image"
          role="tab"
          aria-controls="image"
          aria-selected="false"
        >Images</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="bin" role="tabpanel" aria-labelledby="bin-tab">
        <table class="table table-sm"></table>
      </div>
      <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">...</div>
    </div>
  </div>
</template>

<script>
export default {};
</script>
<style>
</style>
