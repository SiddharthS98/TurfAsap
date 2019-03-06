<template>
    <nav class="black">
        <transition
                name="fade"
                mode="out-in"
        >
            <div class="nav-wrapper"
                 v-if="!isSearching"
                 key="normal"
            >
                <a href="/" class="nav-name">{{ name }}</a>

                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="#" @click="setSearching(true)"  class="right sidenav-trigger hide-on-large-up"><i class="material-icons">search</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li @click="setSearching(true)">
                        <a>Search</a>
                    </li>
                    <li v-if="!auth"><a :href="getstartedurl">Get Started</a></li>
                    <li v-if="auth"><a href="/home">{{ auth.name }}</a></li>
                    <li v-if="auth"><a href="/logout">Logout</a></li>

                </ul>
            </div>
            <div class="nav-wrapper white"
                 key="searching"
                 v-else
            >
                <form>
                    <div class="input-field">
                        <input id="search" class="black-text" type="search" v-model="searchQuery" autofocus placeholder="Search" required>
                        <label class="label-icon " for="search"  @click="setSearching(false)"><i class="material-icons grey-text">close</i></label>
                        <i class="material-icons black-text" @keyup.enter="search()" @click="search()">send</i>
                    </div>
                </form>

            </div>
        </transition>
        <ul class="sidenav" id="mobile-demo">

            <li v-if="!auth"><a :href="getstartedurl">Get Started</a></li>
            <li v-if="auth"><a href="/home">{{ auth.name }}</a></li>
            <li v-if="auth"><a href="/logout">Logout</a></li>
        </ul>
    </nav>

    <!--<v-toolbar
        dark
        class="black"
        v-if="!isSearching"
    >
        <v-toolbar-side-icon></v-toolbar-side-icon>

        <v-toolbar-title>{{ name }}</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-sm-and-down" v-if="!auth">
            <v-btn flat @click="setSearching(true)">Search</v-btn>

            <v-btn flat>Get Started</v-btn>
        </v-toolbar-items>

        <v-toolbar-items class="hidden-sm-and-down" v-else>
            <v-btn flat @click="setSearching(true)">Search</v-btn>
            <v-btn flat>{{ auth.name }}</v-btn>
        </v-toolbar-items>
    </v-toolbar>
    <v-toolbar
            v-else
            tabindex="0"
    >
        <v-btn icon class="hidden-xs-only" @click="setSearching(false)">
            <v-icon>arrow_back</v-icon>
        </v-btn>

        &lt;!&ndash;<v-toolbar-title>Search</v-toolbar-title>&ndash;&gt;
        <v-autocomplete
            @keyup.esc="setSearching(false)"
            v-model="searchQuery"
            label="Search"
            autofocus
            flat
        ></v-autocomplete>
        <v-spacer></v-spacer>

        <v-btn icon class="hidden-xs-only">
            <v-icon>search</v-icon>
        </v-btn>
    </v-toolbar>-->
</template>

<script>
    export default {
        data : () => ({
            isSearching : false,
            searchQuery : '',
        }),
        props : ['name', 'auth', 'getstartedurl', 'searchurl'],
        methods : {
            setSearching (enabled) {
                this.isSearching = enabled
            },
            search() {
                window.location.href = this.searchurl + '?filter=' + this.searchQuery
            }
        }
    }
</script>