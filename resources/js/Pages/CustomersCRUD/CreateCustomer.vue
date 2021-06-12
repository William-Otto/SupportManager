<template>
  <TransitionRoot as="template" :show="true">
    <div static class="fixed z-10 inset-0 overflow-y-auto">
      <div id="addCustomer" class="modal flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div @click="close" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                  <div class="text-lg leading-6 font-medium text-gray-900">
                    Criar cliente
                  </div>
                  <div class="mt-5">
                    <form id="customerForm" @submit.prevent="addCustomer">
                      <div class="form-group">
                        <input type="text" v-model="customer.name"  name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Nome do Cliente"/>                      
                        <select v-model="customer.city_id" name="city_id" id="city_id" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option selected disabled>Selecione uma cidade...</option>
                          <option :value="city.id" v-for="city in cities" :key="city.id">{{city.city_name}}</option>
                        </select>         
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <button @click="addCustomer" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                Criar
              </button>
              <button @click="close" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancelar
              </button>
            </div>
          </div>
        </TransitionChild>
      </div>
    </div>
  </TransitionRoot>
</template>

<script>
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationIcon } from '@heroicons/vue/outline'

export default {
  name: 'Modal',

  components: {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    ExclamationIcon,
  },

  data() {
    return {
      customers: [],
      customer: {
      name: '',
      city_id: '',
      },
      cities: [],
      city: {
        city_name: '',
      }
    }
  },

  methods: {
    async addCustomer() {
      const res = await axios.post('/api/customers', this.customer)
      .then(response => this.customerId = response.data.id)

      if (res.status == 201) {
        Toast.fire({
          icon: 'sucess',
          title:res.data
        })
        document.getElementById('customerForm').reset()
        $('#addCustomer').modal('hide')
      }

    },

    getCustomers(){
      axios.get('/api/customers')
      .then((res) => {
        this.customers = res.data
      }).catch((err) => {
        console.log(err.response)
      });
    },

    getCities() {
      axios.get('api/cities')
      .then((res) => {
        this.cities = res.data
      }).catch((err) => {
        console.log(err.response)
      });
    },

    close(){
      this.$emit('close');
    },
  },

  created() {
    this.getCustomers();
    this.getCities();
  }
}

</script>