<template>
    <div
        class="w-full sm:w-1/2 xl:w-1/3 mb-4"
    >

        <div 
            class="bg-white mx-2 shadow-lg rounded-lg overflow-hidden h-full"
        >
            <div 
                class="sm:flex sm:items-center px-6 py-4"
            >
                <a 
                    :href="teamworkUrl"
                    target="_blank"
                    class="block mx-auto"
                >
                    <img 
                        class="h-16 sm:h-24 rounded-full sm:mb-0 sm:mr-4 sm:ml-0"
                        v-if="memberData['avatar-url']"
                        :src="memberData['avatar-url']" 
                        :alt="member['first-name']"
                    />
                </a>
                <div 
                    class="text-center sm:text-left sm:flex-grow"
                >
                    <div 
                        class="mb-4"
                    >
                        <p 
                            class="text-xl leading-tight"
                        >
                            {{ member['first-name'] }} {{ member['last-name'] }}
                        </p>
                        <p 
                            class="text-sm leading-tight text-grey-dark"
                        >
                            {{ member['email-address'] }}
                        </p>
                    </div>
                    <div>
                        <a 
                            :href="teamworkUrl"
                            target="_blank"
                            class="text-xs font-semibold rounded-full px-4 py-1 leading-normal bg-white border border-purple text-purple hover:bg-purple hover:text-white no-underline"
                        >
                            View Tasks
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="shadow w-full bg-grey-light">
                    <div 
                        class="bg-blue text-xs leading-none py-1 text-center text-white" 
                        :style="capacityBarStyle"
                    >
                        {{capacity}}%
                    </div>
                </div>
            </div>

            <div
                class="px-6 py-4"
            >
                <div
                    class="mb-2"
                >
                    <ul>
                        <li
                            v-for="project in projects"
                            :key="project.id"
                        >
                            {{ project }}
                        </li>
                    </ul>
                </div>
                {{ member.estimatedMinutes / 60 }} hrs
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'member',
        ],
        data: function () {
            return {
                memberData: [],
                tasks: [],
                teamworkUrl: '',
            }
        },
        mounted() {
            this.fetchData();
            setInterval(() => {
                this.fetchData();
            }, 30000);
        },
        computed: {
            projects: function () {
                return this.tasks.map(function(item, i){
                    return item['project-name'];
                })
                .filter(this.onlyUnique)
                .sort();
            },
            capacity: function() {
                return Math.round((this.member.estimatedMinutes / 60) / 36 * 100);
            },
            capacityBarStyle: function() {
                return `width: ${this.capacity}%`;
            }
        },
        methods: {
            fetchData: function() {
                this.getMemberData()
                    .then((data) => {
                        this.memberData = data.person;
                        this.teamworkUrl = `https://go.redolive.com/#people/${this.memberData.id}/tasks`;
                    })
                    .then((data) => {
                        this.getMemberTasks()
                            .then((data) => {
                                this.tasks = data;
                            })
                    });
            },
            getMemberData: function () {
                return fetch(`/api/user/${this.member.id}`)
                    .then((response) => {
                        return response.json();
                    });
            },
            getMemberTasks: function () {
                return fetch(`/api/user-tasks/${this.member.id}`)
                    .then((response) => {
                        return response.json();
                    });
            },
            onlyUnique: function(value, index, self) { 
                return self.indexOf(value) === index;
            }
        }
    }
</script>
