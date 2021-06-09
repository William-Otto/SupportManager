<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Entre na sua conta
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Ou
          {{ ' ' }}
          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
            inicie sua avaliação gratuita de 14 dias
          </a>
        </p>
      </div>
      <form @submit.prevent="submit" class="mt-8 space-y-6">
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <jet-label for="email" value="Email" />
            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
          </div>
          <div>
            <jet-label for="password" value="Senha" />
            <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <jet-checkbox name="remember" v-model:checked="form.remember" />
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
              Lembrar de mim
            </label>
          </div>

          <div class="text-sm">
            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
              Esqueceu sua senha?
            </inertia-link>
          </div>
        </div>

        <div>
          <jet-button class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
          </span>
            Entrar
          </jet-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import { LockClosedIcon } from '@heroicons/vue/solid'

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    LockClosedIcon,
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },
  data() {
    return {
      form: this.$inertia.form({
      email: '',
      password: '',
      remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
        .transform(data => ({
          ... data,
          remember: this.form.remember ? 'on' : ''
        }))
      .post(this.route('login'), {
      onFinish: () => this.form.reset('password'),
      })
    }
  }
}
</script>