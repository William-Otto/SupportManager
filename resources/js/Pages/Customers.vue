<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button @click="isOpen=!isOpen" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Novo
                </button>
                <div v-if="isOpen">
                    <CreateCustomer />
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">                
                    <CustomersDataTable ref='modal'/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import CustomersDataTable from '@/Pages/CustomersDataTable';
    import CreateCustomer from '@/Pages/CustomersCRUD/CreateCustomer';
    
    export default {
        components: {
            AppLayout,
            CustomersDataTable,
            CreateCustomer,
        },

        data: function() {
            return {
                isOpen: false
            };
        }
    }

</script>
