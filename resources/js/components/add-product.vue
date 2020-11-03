<template>
  <div class="add-shop">
    <h3>{{ id ? "Update Item" : "Add Item" }}</h3>
    <form @submit.prevent="addItem" @keydown="onKeydown($event)">
      <div class="col-8">
        <div class="form-group">
          <label>Item name</label>
          <input name="name" type="text" class="form-control" v-model="form.name" required />
          <div v-if="errors.name" class="error">{{ errors.name[0] }}</div>
        </div>
      </div>
      <div class="col-8">
        <div class="form-group">
          <label>Item Description</label>
          <textarea name="description" class="form-control" v-model="form.description" required></textarea>
          <div v-if="errors.description" class="error">{{ errors.description[0] }}</div>
        </div>
      </div>
      <div class="col-8">
        <div class="form-group">
          <label>Price XAF</label>
          <input name="cost" class="form-control" type="number" v-model="form.cost" required />
          <div v-if="errors.cost" class="error">{{ errors.cost[0] }}</div>
        </div>
      </div>
      <div class="col-8">
        <div @click="startFileUpload()" class="form-group">
        <label class="custom-file-label" for="photo">Add a Photo</label>
          <input
            type="file"
            accept="image/*"
            name="photo"
            id="photo-picker"
            value="Select Image"
            class="form-control my-field"
            @input="updatePhoto"
            :required="id ? false : true"
          />
        </div>
      </div>
      <div :key="image_url" v-show="image_url !== null" class="image-previewer">
        <div
          class="image-shower"
          :style="{
                                    'background-image': `url(${image_url})`
                                }"
        >
          <div class="closer-container">
            <div class="closer-spacer"></div>
            <div class="closer">
              <button type="button" class="closer-button">
                <i @click="destroy()" class="material-icons">X</i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="form-group">
          <input :value="id ? 'Update' : 'Add'" class="btn-success" type="submit" />
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { serialize } from "object-to-formdata"; // you must install it with npm install
import ABAPI from "./api";

export default {
  name: "add-shop",
  props: {
    id: {
      type: String,
      required: false
    }
  },
  computed: {
    form: {
      get() {
        return this.fo;
      },
      set(val) {
        this.fo = val;
        Object.keys(val).forEach(ele => {
          this.errors[ele] = null;
        });
      }
    }
  },
  data() {
    return {
    image_url:null,
      fo: {
        name: "",
        description: "",
        cost: 100,
        photo: null
      },
      errors: {}
    };
  },
  mounted() {
    if (this.id) {
      ABAPI.get("/fetch-item/" + this.id).then(res => {
        this.fo = res.data[0];
        this.image_url = this.fo.picture[0].url
      });
    }
  },
  methods: {
    destroy(){
        this.image_url = null
        this.form.photo = null
    },
    startFileUpload(){
        document.getElementById('photo-picker').click();
    },
    async addItem() {
      ABAPI.post("/manage-product", serialize(this.form), {})
        .then(res => {
          window.location = "/manage-product";
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
    updatePhoto(e) {
      this.form.photo = e.target.files[0];
      const reader = new FileReader()
      reader.onload = e => {
        this.image_url = e.target.result
      }
      reader.readAsDataURL(e.target.files[0]);
      
    },
    onKeydown(event) {
    }
  }
};
</script>

<style scoped lan="scss">
.custom-file-label::after {
  content: "Select Image";
}
.my-field{
    cursor: pointer;
}
.closer-button {
  margin: 3px;
  background-color: rgba(0, 0, 0, 0.5);
  border-width: 0;
  height: 30px;
  width: 30px;
  cursor: pointer;
  padding: 0;
  border-radius: 42px;
}
material-icons {
  color: #fff;
  font-size: 22px;
  margin-top: 2px;
}
.error {
  color: red;
  font-weight: bold;
}
.image-previewer {
    margin-bottom: 20px;
}
.image-shower {
    height: 400px;
    width: 100%;
    margin-bottom: 10px;
    border-radius: 4px;
}
</style>
