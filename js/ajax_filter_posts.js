!function(t){$doc=t(document),$doc.ready(function(){t("#container-async").on("click","a[data-filter], .pagination a",function(a){a.preventDefault&&a.preventDefault(),$this=t(this),$this.data("filter")?($this.closest("ul").find(".active").removeClass("active"),$this.parent("li").addClass("active"),$page=$this.data("page")):($page=parseInt($this.attr("href").replace(/\D/g,"")),$this=t(".nav-filter .active a")),$params={page:$page,tax:$this.data("filter"),term:$this.data("term"),qty:$this.closest("#container-async").data("paged")},function(a){$container=t("#container-async"),$content=$container.find(".content"),$status=$container.find(".status"),$status.text("Loading posts ..."),t.ajax({url:rws.ajax_url,data:{action:"do_filter_posts",nonce:rws.nonce,params:a},type:"post",dataType:"json",success:function(t,a,s){200===t.status?$content.html(t.content):201===t.status?$content.html(t.message):$status.html(t.message)},error:function(t,a,s){$status.html(a)},complete:function(t,a){msg=a,"success"===a&&(msg=t.responseJSON.found),$status.text("Posts found: "+msg)}})}($params)}),t('a[data-term="physiotherapy"]').trigger("click")})}(jQuery);