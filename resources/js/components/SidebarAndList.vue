<template>
  <div>
    <el-row>
      <el-container>
        <el-col :xs="1" :sm="6" :md="4" :lg="3" :xl="1">
          <el-aside width="200px">
            <el-menu
              default-active="1"
              class="el-menu-vertical-demo"
              @open="handleOpen"
              @close="handleClose"
              background-color="#000000"
              text-color="#fff"
              active-text-color="#ffd04b"
            >
              <router-link :to="{ name: 'profile'}">
                <el-menu-item index="8">
                  <i class="fas fa-id-badge yellow"></i>
                  <span slot="title" class="sidebar-padding">Profile</span>
                </el-menu-item>
              </router-link>

              <router-link :to="{ name: 'indexBooks'}">
                <el-menu-item index="3">
                  <i class="fas fa-book-open hotorange"></i>
                  <span slot="title" class="sidebar-padding">Books</span>
                </el-menu-item>
              </router-link>

              <router-link v-if="isadmin" :to="{ name: 'indexCategories'}">
                <el-menu-item index="4">
                  <i class="fas fa-boxes powderblue"></i>
                  <span slot="title" class="sidebar-padding">Categories</span>
                </el-menu-item>
              </router-link>

              <router-link v-if="isadmin" :to="{ name: 'indexDepartments'}">
                <el-menu-item index="5">
                  <i class="fas fa-building customgreen"></i>
                  <span slot="title" class="sidebar-padding">Departments</span>
                </el-menu-item>
              </router-link>

              <router-link v-if="isadmin" :to="{ name: 'indexAccesslevels'}">
                <el-menu-item index="7">
                  <i class="fas fa-ban purple"></i>
                  <span slot="title" class="sidebar-padding">Access Levels</span>
                </el-menu-item>
              </router-link>

              <router-link v-if="isadmin" :to="{ name: 'indexUsers'}">
                <el-menu-item index="6">
                  <i class="fas fa-users mustard"></i>
                  <span slot="title" class="sidebar-padding">Users</span>
                </el-menu-item>
              </router-link>

              <router-link v-if="isadmin" :to="{ name: 'reports'}">
                <el-menu-item index="9">
                  <i class="fas fa-file darkblue"></i>
                  <span slot="title" class="sidebar-padding">Reports</span>
                </el-menu-item>
              </router-link>
            </el-menu>
          </el-aside>
        </el-col>
        <el-col :xs="23" :sm="18" :md="20" :lg="21" :xl="23">
          <el-container>
            <el-main>
              <router-view :choices.sync="choices"></router-view>
            </el-main>
          </el-container>
        </el-col>
      </el-container>
    </el-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      choices: [],
      isadmin: false
    };
  },
  methods: {
    handleOpen(key, keyPath) {},
    handleClose(key, keyPath) {},
    getChoices() {
      axios.get("/api/choices").then(response => {
        this.choices = response.data;
      });
    },
    getAdmin() {
      axios.get("/api/users/isadmin").then(response => {
        this.isadmin = response.data;
      });
    }
  },
  created() {
    this.getChoices();
    this.getAdmin();
  }
};
</script>

<style>
.el-header {
  background-color: #b3c0d1;
  color: #333;
  line-height: 60px;
}
.el-aside {
  color: #333;
}
.sidebar-padding {
  padding-left: inherit;
}
.el-menu-item.is-active {
  background-color: #2c3a40 !important;
  color: white;
}
</style>
