<template>
    <div
        class="w-full sm:w-1/2 xl:w-1/3 mb-4"
    >

        <div 
            class="bg-white mx-3 my-2 shadow-lg rounded-lg overflow-hidden h-full"
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
                            class="text-xs font-semibold rounded-full px-4 py-1 leading-normal bg-white border border-blue text-blue hover:bg-blue hover:text-white no-underline"
                        >
                            View Tasks
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="overflow-hidden"
            >
                <div 
                    class="shadow w-full bg-grey-light"
                >
                    <div 
                        :class="capacityBarClasses"
                        :style="capacityBarStyle"
                    >
                        {{capacity}}%
                    </div>
                </div>

                <p
                    class="my-1 text-right mx-4"
                >
                    {{ totalHours }} total hrs
                </p>                
            </div>

            <div
                class="mx-6 px-6 py-4"
            >
                <div
                    class="mb-2"
                >
                        <div
                            v-for="project in projects"
                            :key="project.id"
                            class="my-2"
                        >
                            <p
                                class="my-1"
                            >
                                {{ project }}
                            </p>

                            <div
                                class="overflow-hidden"
                            >
                                <div 
                                    class="shadow w-full bg-grey-light"
                                >
                                    <div 
                                        class="bg-blue text-xs leading-none py-1 text-center text-white"
                                        :style="capacityBarStyle"
                                    >
                                        {{capacity}}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
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
            },
            capacityBarClasses: function() {
                const bg = this.capacity > 90 ? 'bg-red' : this.capacity > 80 ? 'bg-orange' : 'bg-blue';
                return `${bg} text-xs leading-none py-1 text-center text-white`;
            },
            totalHours: function() {
                if(!this.tasks.length){
                    return 0;
                }
                return Math.round( this.tasks.map(function(item,i){
                    return +item['estimated-minutes'];
                }).reduce(function(total, item){
                    return total + item;
                }) / 60 );
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
