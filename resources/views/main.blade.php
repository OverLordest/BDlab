@extends('sample')

@section('title')Главная страница@endsection

@section('content')

    <div id="MainPage">
        <v-app>
            <v-main>
                <v-data-table
                    :headers="headers"
                    :items="show_tables_info"
                    class="elevation-1">
                    <!--v-model="selected"-->
                    <template
                        v-slot:item._actions="{ item }">
                        <v-btn
                            icon @click = "ShowDialogChange(item)">
                            <v-icon>
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                        <v-btn icon @click = "ShowDialogDelete(item)">
                            <v-icon>
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-main>
        </v-app>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        new Vue({
            el: '#MainPage',
            vuetify: new Vuetify(),
            data(){
                return{
                    //selected:[],
                    show_tables_info_:[],
                    show_tables_info:[],
                    dialog_change: false,
                    dialog_delete: false,
                    headers: [
                        {
                            text: 'Код фьючерса',
                            align: 'start',
                            value: 'kod',
                        },
                        { text: 'Дата погашения', value: 'exec_data' },
                        { text: 'Дата торгов', value: 'torg_date' },
                        { text: 'Максимальная цена', value: 'quotation' },
                        { text: 'Кол-во продаж', value: 'num_contr' },
                        { text: 'Изменить/удалить', value: '_actions'},
                    ],
                }
            },
            methods:{
                ShowUnitedTable(){
                    this.show_tables_info_ = []
                    fetch('ShowUnitedTable',{
                        method: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    })

                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            this.show_tables_info = data
                        })
                },
            },
            mounted: function (){
                this.ShowUnitedTable();
            }
        })
    </script>

@endsection
