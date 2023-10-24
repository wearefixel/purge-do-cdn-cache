import PurgeDoCdnCache from './components/PurgeDoCdnCache.vue'

Statamic.booting(() => {
    Statamic.$components.register('purge-do-cdn-cache', PurgeDoCdnCache)
})
