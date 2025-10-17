<template>

        <div class="flex mx-5">
          <!-- Sidebar -->
          <aside
            class="mt-6 mb-4 w-64transform transition-transform duration-300 ease-in-out md:translate-x-0"
          >
            <nav class="mt-5 overflow-y-auto space-y-5">
              <a
                href="#"
                @click="choice = 'dashboard'"
                class="flex gap-2 items-center px-4 py-2 text-[#007e90] font-medium"
              >
                <svg
                  width="28"
                  height="25"
                  viewBox="0 0 28 25"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M11.6857 24.0477V15.6985H17.096V24.0477H23.8588V12.9154H27.9165L14.3909 0.391541L0.865234 12.9154H4.92293V24.0477H11.6857Z"
                    fill="#017E91"
                  />
                </svg>

                Dashboard
              </a>

              <div>
                <button
                  @click="choice = 'users'"
                  class="font-medium cursor-pointer w-full flex items-center justify-between px-4 py-2 text-[#007e90] hover:bg-linear-to-r/decreasing from-[#abecf0] white" 
                >
                  <div class="flex items-center gap-2">
                    <svg
                      width="23"
                      height="23"
                      viewBox="0 0 23 23"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M11.3908 11.4501C14.38 11.4501 16.8011 8.95921 16.8011 5.8839C16.8011 2.8086 14.38 0.317749 11.3908 0.317749C8.40166 0.317749 5.98057 2.8086 5.98057 5.8839C5.98057 8.95921 8.40166 11.4501 11.3908 11.4501ZM11.3908 14.2331C7.77948 14.2331 0.570312 16.0978 0.570312 19.7993V22.5824H22.2113V19.7993C22.2113 16.0978 15.0022 14.2331 11.3908 14.2331Z"
                        fill="#017E91"
                      />
                    </svg>
                    Users
                  </div>
                </button>
              </div>
              <div>
               
              </div>

              <div>
                <button
                  @click="choice = 'allreviews'"
                  class="font-medium cursor-pointer w-full flex items-center justify-between px-4 py-2 text-[#007e90] hover:bg-linear-to-r/decreasing from-[#abecf0] white"
                >
                  <div class="flex items-center gap-2">
                    <svg
                      width="25"
                      height="29"
                      viewBox="0 0 25 29"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M6.56345 0.585083H17.8993C22.0774 0.585083 24.4038 3.06202 24.4038 7.30622V21.6808C24.4038 25.9946 22.0774 28.4159 17.8993 28.4159H6.56345C2.45166 28.4159 0.0576172 25.9946 0.0576172 21.6808V7.30622C0.0576172 3.06202 2.45166 0.585083 6.56345 0.585083ZM6.92864 7.06965V7.05574H10.9715C11.5544 7.05574 12.0278 7.54278 12.0278 8.13975C12.0278 8.75342 11.5544 9.24046 10.9715 9.24046H6.92864C6.34569 9.24046 5.87364 8.75342 5.87364 8.15506C5.87364 7.55669 6.34569 7.06965 6.92864 7.06965ZM6.92864 15.5302H17.5327C18.1143 15.5302 18.5877 15.0432 18.5877 14.4448C18.5877 13.8465 18.1143 13.358 17.5327 13.358H6.92864C6.34569 13.358 5.87364 13.8465 5.87364 14.4448C5.87364 15.0432 6.34569 15.5302 6.92864 15.5302ZM6.92864 21.8895H17.5327C18.0724 21.8339 18.4795 21.3594 18.4795 20.8041C18.4795 20.2336 18.0724 19.7605 17.5327 19.7048H6.92864C6.52287 19.6631 6.13063 19.8579 5.91422 20.2197C5.69781 20.5676 5.69781 21.0268 5.91422 21.3886C6.13063 21.7365 6.52287 21.9452 6.92864 21.8895Z"
                        fill="#017E91"
                      />
                    </svg>
                    All reviews
                  </div>
                </button>
              </div>

              <a
                href="#"
                @click="choice = 'settings'"
                class="font-medium gap-2 cursor-pointer flex items-center px-4 py-2 text-[#007e90] hover:bg-linear-to-r/decreasing from-[#abecf0] white"
              >
                <svg
                  width="27"
                  height="29"
                  viewBox="0 0 27 29"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M14.2012 0.783203C15.224 0.783203 16.1507 1.36771 16.6621 2.23047C16.9108 2.64779 17.0765 3.16263 17.0352 3.70508C17.0075 4.12242 17.1315 4.54015 17.3525 4.92969C18.0574 6.1124 19.6196 6.55832 20.8359 5.89062C22.2043 5.08356 23.9328 5.56975 24.7207 6.94727L25.6465 8.58984C26.4481 9.96745 26.0053 11.7342 24.623 12.5273C23.4482 13.2371 23.0343 14.8102 23.7393 16.0068C23.9604 16.3824 24.2088 16.7027 24.5957 16.8975C25.0794 17.1618 25.4532 17.5787 25.7158 17.9961C26.2273 18.8588 26.1851 19.9173 25.6875 20.8496L24.7207 22.5195C24.2092 23.41 23.2548 23.9658 22.2734 23.9658C21.7897 23.9658 21.2508 23.827 20.8086 23.5488C20.4492 23.3123 20.0341 23.2285 19.5918 23.2285C18.2235 23.2287 17.0766 24.3842 17.0352 25.7617C17.035 27.3617 15.7632 28.6141 14.1738 28.6143H12.2939C10.6906 28.6143 9.41915 27.3618 9.41895 25.7617C9.3913 24.3841 8.24344 23.2285 6.875 23.2285C6.41904 23.2285 6.00465 23.3124 5.65918 23.5488C5.21686 23.8271 4.66333 23.9658 4.19336 23.9658C3.1984 23.9657 2.24485 23.4098 1.7334 22.5195L0.779297 20.8496C0.26786 19.9451 0.240516 18.8588 0.751953 17.9961C0.973132 17.5788 1.38771 17.1618 1.85742 16.8975C2.24442 16.7027 2.49355 16.3825 2.72852 16.0068C3.41965 14.8101 3.005 13.237 1.83008 12.5273C0.461814 11.7342 0.0189858 9.96739 0.806641 8.58984L1.7334 6.94727C2.53521 5.56998 4.24874 5.08365 5.63086 5.89062C6.83343 6.55856 8.39563 6.1125 9.10059 4.92969C9.32168 4.54011 9.44659 4.12247 9.41895 3.70508C9.39138 3.16251 9.5431 2.64784 9.80566 2.23047C10.3171 1.36779 11.243 0.811127 12.252 0.783203H14.2012ZM13.2471 10.7744C11.0771 10.7746 9.32227 12.5283 9.32227 14.7129C9.32247 16.8973 11.0772 18.6365 13.2471 18.6367C15.4171 18.6367 17.1316 16.8974 17.1318 14.7129C17.1318 12.5282 15.4172 10.7744 13.2471 10.7744Z"
                    fill="#017E91"
                  />
                </svg>

                Settings
              </a>
              <a
                href="#"
                @click="choice = 'logout'"
                class="font-medium gap-2 cursor-pointer flex items-center px-4 py-2 text-[#007e90] hover:bg-linear-to-r/decreasing from-[#abecf0] white"
              >
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M8 20H4C3.46957 20 2.96086 19.7893 2.58579 19.4142C2.21071 19.0391 2 18.5304 2 18V4C2 3.46957 2.21071 2.96086 2.58579 2.58579C2.96086 2.21071 3.46957 2 4 2H8M15 16L20 11M20 11L15 6M20 11H8"
                    stroke="#017E91"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>

                Logout
              </a>
            </nav>
            <!-- Modules -->
          </aside>

          <div class="flex-1 flex flex-col md:ml-22" v-if="active == 'urlShortner'">
            <urlShortener />
          </div>
          <div class="flex-1 flex flex-col md:ml-18" v-if="active == 'users'">
            <wallet />
          </div>

          <div class="flex-1 flex flex-col md:ml-20" v-if="active == 'allreviews'">
            <marketPlace />
          </div>
          <div class="flex-1 flex flex-col md:ml-20" v-if="active == 'settings'">
            <timeTracker />
          </div>
           <div class="flex-1 flex flex-col md:ml-20" v-if="active == 'settings'">
            <Investment />
          </div>
        </div>
     
</template>

<script setup>

</script>

<style lang="scss" scoped></style>
