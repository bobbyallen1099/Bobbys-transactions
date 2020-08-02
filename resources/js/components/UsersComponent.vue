<template>
   <data-table
    :columns="columns"
    url="/api/users">
    </data-table>
</template>

<script>
    import ViewButton from './ViewButton.vue';
    export default {
        data() {
            return {
                columns: [
                    {
                        label: 'Name',
                        name: 'name',
                        orderable: false,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        orderable: false,
                    },
                    {
                        label: 'Admin',
                        name: 'is_admin',
                        orderable: false,
                    },
                    {
                        label: 'View',
                        name: 'View',
                        orderable: false,
                        classes: {
                            'btn': true,
                            'btn-primary': true,
                            'btn-sm': true,
                        },
                        event: "click",
                        handler: this.displayRow,
                        component: ViewButton,
                    },
                ]
            }
        },
        components: {
            ViewButton,
        },
        methods: {
            displayRow(data) {
                location.href = "/admin/users/"+ data.id
            },
        },
    }
</script>
