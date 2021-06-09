<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <CustomersDataTable />
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomer">
        Novo
        </button>

        <div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerLabel">Criar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form @submit.prevent="addCustomer">
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar mudanças</button>
            </div>
            </div>
        </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CustomersDataTable from '@/Pages/CustomersDataTable'

    export default {
        components: {
            AppLayout,
            CustomersDataTable,
        },
    }
</script>
