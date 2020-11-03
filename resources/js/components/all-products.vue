<template>
  <!--Section: Block Content-->
  <section>
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div v-for="item in items" :key="item.id" class="col-lg-12">
        <div class="pt-4 wish-list">
          <div class="row mb-8">
            <div class="col-md-8 col-lg-3 col-xl-3">
              <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                <a href="#!">
                  <div class="mask">
                    <img
                      class="img-fluid w-100"
                      :src=" item.picture && item.picture[0] && item.picture[0].url"
                    />
                  </div>
                </a>
              </div>
            </div>
            <div class="col-md-7 col-lg-9 col-xl-9">
              <div>
                <div class="d-flex justify-content-between">
                  <div>
                    <h5>{{item.name}}</h5>
                    <p class="mb-3 text-muted text-uppercase small">{{ item.description }}</p>
                    
                  </div>
                  <div>
                    <div class="def-number-input number-input safari_only mb-0 w-100">
                      <button type="button" @click="gotoEdit(item.id)" class="btn-default">Edit Item</button>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <button class="btn-danger"
                      @click="deleteItem(item.id)"
                      >
                      Remove item
                  </button>
                  <p class="mb-0">
                    <span>
                      <strong id="summary">{{item.cost}} XAF</strong>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <hr class="mb-4" />
        </div>
      </div>
    </div>
    <!-- Grid row -->
  </section>
  <!--Section: Block Content-->
</template>

<script>
import ABAPI from "./api";
export default {
  name: "all-items",
  data() {
    return {
      items: []
    };
  },
  methods:{
      gotoEdit(id){
          window.location = 'dashboard/manage-product/'+id
      },
      deleteItem(id){
        ABAPI.delete("/manage-product/"+id).then(() => {
          window.location.reload()
        })
      }
  },
  mounted() {
    ABAPI.get("/fetch-items").then(items => {
        console.warn(items)
      this.items = items.data;
    });
  }
};
</script>

<style></style>
