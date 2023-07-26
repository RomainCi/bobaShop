<template>
  <section>
    <admin-home-page-component></admin-home-page-component>
  </section>
  <section>
    <admin-menu-store-component text="cliquer ici pour ajouter un nouveau menu"
                                @storeEmit="this.menus.push($event)"
                                title="Menus">

    </admin-menu-store-component>
    <div class="container">
      <admin-menu-component v-for="(value,index) in menus" :key="index" :index="index"
                            :productsMenu="menus"
                            :edit="edit0"
                            @newProducts="menus[index] = $event"
                            @editEmit="edit0 = $event">

      </admin-menu-component>
    </div>
  </section>
  <section>
    <AdminPearlSyrupStoreComponent text="cliquer ici pour ajouter une nouvelle perle"
                                   route="pearls"
                                   title="Perles"
                                   @storeEmit="this.pearls.push($event)">

    </AdminPearlSyrupStoreComponent>
    <div class="container">
      <admin-pearl-syrup-component v-for="(value,index) in pearls" :key="index"
                                   :index="index"
                                   :productsPearlSyrup="pearls"
                                   :edit="edit1"
                                   route="pearls"
                                   @newProducts="pearls[index] = $event"
                                   @editEmit="edit1 = $event">

      </admin-pearl-syrup-component>
    </div>
  </section>
  <section>
    <AdminPearlSyrupStoreComponent text="cliquer ici pour ajouter un nouveau sirop"
                                   route="syrups"
                                   title="Sirops"
                                   @storeEmit="this.syrups.push($event)">

    </AdminPearlSyrupStoreComponent>
    <div class="container">
      <admin-pearl-syrup-component v-for="(value,index) in syrups" :key="index"
                                   :index="index"
                                   :productsPearlSyrup="syrups"
                                   :edit="edit2"
                                   route="syrups"
                                   @newProducts="syrups[index] = $event"
                                   @editEmit="edit2 = $event">

      </admin-pearl-syrup-component>
    </div>
  </section>
  <section>
    <admin-tea-store-component text="cliquer ici pour ajouter un nouveau thé"
                               @storeEmit="this.teas.push($event)"
                               title="Thé">

    </admin-tea-store-component>
    <div class="container">
      <admin-tea-component v-for="(value,index) in teas" :key="index"
                           :index="index"
                           :productsTea="teas"
                           @editEmit="edit3 = $event"
                           @newProducts="teas[index] = $event"
                           @destroyProducts="teas.splice(this.index,1)"
                           :edit="edit3">
      </admin-tea-component>
    </div>
  </section>
  <section>
    <admin-side-store-component text="cliquer ici pour ajouter un nouveau side"
                                @storeEmit="this.sides.push($event)"
                                title="Sides">

    </admin-side-store-component>
    <div class="container">
      <admin-side-component v-for="(value,index) in sides" :key="index"
                            :index="index"
                            :productsSide="sides"
                            @editEmit="edit4 = $event"
                            @newProducts="sides[index] = $event"
                            @destroyProducts="sides.splice(this.index,1)"
                            :edit="edit4">

      </admin-side-component>
    </div>
  </section>
</template>

<script>
import AdminHomePageComponent from "@/components/panel/AdminHomePageComponent.vue";
import AdminMenuComponent from "@/components/panel/AdminMenuComponent.vue";
import AdminPearlSyrupComponent from "@/components/panel/AdminPearl&SyrupComponent.vue";
import AdminPearlSyrupStoreComponent from "@/components/panel/AdminPearl&SyrupStoreComponent.vue";
import AdminTeaComponent from "@/components/panel/AdminTeaComponent.vue";
import AdminTeaStoreComponent from "@/components/panel/AdminTeaStoreComponent.vue";
import AdminSideComponent from "@/components/panel/AdminSideComponent.vue";
import AdminSideStoreComponent from "@/components/panel/AdminSideStoreComponent.vue";
import AdminMenuStoreComponent from "@/components/panel/AdminMenuStoreComponent.vue";

export default {
  name: "AdminPanelComponent",
  components: {
    AdminHomePageComponent,
    AdminMenuComponent,
    AdminPearlSyrupComponent,
    AdminPearlSyrupStoreComponent,
    AdminTeaComponent,
    AdminTeaStoreComponent,
    AdminSideComponent,
    AdminSideStoreComponent,
    AdminMenuStoreComponent,
  },
  data() {
    return {
      menus: [],
      pearls: [],
      syrups: [],
      teas: [],
      sides: [],
      edit0: false,
      edit1: false,
      edit2: false,
      edit3: false,
      edit4: false,
    }
  },
  mounted() {
    this.indexProducts();
  },
  methods: {
    async indexProducts() {
      const res = await axios.get('api/products')
      console.log(res, 'admin');
      this.menus = res.data.menus.data;
      this.pearls = res.data.pearls.data;
      this.syrups = res.data.syrups.data;
      this.teas = res.data.teas.data;
      this.sides = res.data.sides.data;
    },

  }
}
</script>

<style scoped>
.container {
  display: flex;
  gap: 40px;
  justify-content: center;
  flex-wrap: wrap;
}

</style>