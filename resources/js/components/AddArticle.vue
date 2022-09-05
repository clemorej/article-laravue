<template>
    <v-container
        fluid
    >
    <v-row
        align="center"
        justify="center"
    >
        <v-col
            cols="8"
        >
            <v-btn color="primary" :to="{name:'add'}">Add article</v-btn>
        </v-col>
    </v-row>
    <v-row
        align="center"
        justify="center"
    >
        <v-col
            cols="8"
        >
            <v-card class="elevation-6">
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th
                                class="text-left"
                                v-for="(header,i) in headers"
                                :key="i"
                                v-text="header"
                            ></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(article,id) in articles" :key="id">
                            <td>{{ article.title }}</td>
                            <td><a href="#"/>/article/{{ article.id }}</td>
                            <td>{{ article.created_at }}</td>
                            <td>{{ article.updated_at }}</td>
                            <td><v-icon v-if="article.published">mdi-check</v-icon></td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-card>
        </v-col>
    </v-row>
    <v-row
        justify="center"
    >
        <v-col
            cols="2"
        >
            <v-select
                :items="rowsPerPageArray"
                v-model="rowsPerPage"
                label="Items per page"
                outlined
                small
                dense
            />
        </v-col>
        <v-col
            cols="6"
            class="d-inline-flex pa-2 justify-sm-end"
        >
            <v-pagination
                v-model="currentPage"
                :length="lastPage"
                :total-visible="10"
            ></v-pagination>
        </v-col>
    </v-row>
    </v-container>
</template>

<script>
export default {
    name: 'Home',

}
</script>
