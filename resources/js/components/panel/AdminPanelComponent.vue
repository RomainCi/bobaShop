<template>

    <div class="admin-panel">
        <aside class="admin-menu">
            <ul>
                <li :class="{ 'active': isActive('home') }" @click="setActiveSection('home')">Accueil</li>

                <li :class="{ 'active': isActive('menu') }"
                    @click="setActiveSection('menu')">Menus
                </li>
                <li :class="{ 'active': isActive('pearl') }"
                    @click="setActiveSection('pearl')">Perles
                </li>
                <li :class="{ 'active': isActive('syrup') }"
                    @click="setActiveSection('syrup')">Sirops
                </li>
                <li :class="{ 'active': isActive('tea') }"
                    @click="setActiveSection('tea')">Thé
                </li>
                <li :class="{ 'active': isActive('side') }"
                    @click="setActiveSection('side')">Sides
                </li>
            </ul>
        </aside>
        <section v-if="activeSection === 'home'">
            <admin-home-page-component></admin-home-page-component>
        </section>
        <section v-if="activeSection=== 'menu'">
            <admin-menu-store-component text="Pour ajouter un nouveau menu cliquer ici !"
                                        @storeEmit="this.menus.push($event)"
                                        @false="this.show0 = $event"
                                        @true="this.show0 = $event"
                                        title="Menus">

            </admin-menu-store-component>
            <div class="container" v-if="show0">
                <admin-menu-component v-for="(value,index) in menus" :key="index" :index="index"
                                      :productsMenu="menus"
                                      :edit="edit0"
                                      @newProducts="menus[index] = $event"
                                      @editEmit="edit0 = $event">

                </admin-menu-component>
            </div>
        </section>
        <section v-if="activeSection === 'pearl'">
            <AdminPearlSyrupStoreComponent text="Pour ajouter une nouvelle perle cliquer ici !"
                                           route="pearls"
                                           title="Perles"
                                           @false="this.show1 = $event"
                                           @true="this.show1 = $event"
                                           @storeEmit="this.pearls.push($event)">

            </AdminPearlSyrupStoreComponent>
            <div class="container" v-show="show1">
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
        <section v-if="activeSection === 'syrup'">
            <AdminPearlSyrupStoreComponent text="Pour ajouter un nouveau sirop cliquer ici !"
                                           route="syrups"
                                           title="Sirops"
                                           @false="this.show2 = $event"
                                           @true="this.show2 = $event"
                                           @storeEmit="this.syrups.push($event)">

            </AdminPearlSyrupStoreComponent>
            <div class="container" v-show="show2">
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
        <section v-if="activeSection=== 'tea'">
            <admin-tea-store-component text="Pour ajouter un nouveau thé cliquer ici !"
                                       @storeEmit="this.teas.push($event)"
                                       @false="this.show3 = $event"
                                       @true="this.show3 = $event"
                                       title="Thé">

            </admin-tea-store-component>
            <div class="container" v-show="show3">
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
        <section v-if="activeSection=== 'side'">
            <admin-side-store-component text="cliquer ici pour ajouter un nouveau side"
                                        @storeEmit="this.sides.push($event)"
                                        @false="this.show4 = $event"
                                        @true="this.show4 = $event"
                                        title="Sides">

            </admin-side-store-component>
            <div class="container" v-show="show4">
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
    </div>
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
    emits: ['false', 'true'],
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
            delay: null,
            edit0: false,
            edit1: false,
            edit2: false,
            edit3: false,
            edit4: false,
            activeSection: 'home',
            show0: true,
            show1: true,
            show2: true,
            show3: true,
            show4: true,
        }
    },
    mounted() {
        // Déterminez si l'affichage est mobile (par exemple, lorsque la largeur est inférieure à un certain point de rupture)
        this.isMobile = window.innerWidth < 768; // Vous pouvez ajuster la largeur de rupture en fonction de vos besoins

        // Écoutez les modifications de la largeur de la fenêtre pour mettre à jour l'état isMobile
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 768; // Vous pouvez ajuster la largeur de rupture en fonction de vos besoins
        });
        this.indexProducts();
    },
    methods: {
        isActive(section) {
            return this.activeSection === section;
        },
        setActiveSection(section) {
            console.log(section)
            this.activeSection = section;
            this.show0 = this.show1 = this.show2 = this.show3 = this.show4 = true;
            this.edit0 = this.edit1 = this.edit2 = this.edit3 = this.edit4 = false;
        },
        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
        },
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
.admin-panel {
    display: flex;
    height: 91.5vh;
}

.admin-menu {
    width: 100px;
    background-color: #EAB99F;
    padding: 20px;
}

.container {
    display: flex;
    gap: 40px;
    justify-content: center;
    flex-wrap: wrap;
}


.lastSection {
    border: none;
}

section {
    width: 100%;
}


.admin-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
}

.admin-menu li {
    margin-bottom: 10px;
    color: white;
    /* Ajoutez un effet de transition pour une animation fluide */
    transition: color 0.3s;
    cursor: pointer;
}

.admin-menu li.active {
    color: black; /* Couleur pour l'élément actif */
}


.admin-menu li a:hover {
    color: #007bff;
}

@media screen and (max-width: 900px) {
    .admin-panel {
        flex-direction: column;
    }

    .admin-menu {
        width: 90%;
        padding: 0;
        margin-top: 10px;
        border-radius: 20px;
        margin-left: auto;
        margin-right: auto;
    }

    .admin-menu ul {
        display: flex;
        justify-content: space-around;
        height: 40px;
        align-items: center;
        flex-direction: row;
    }

    .admin-menu ul li {
        margin: 0;
    }
}
</style>
