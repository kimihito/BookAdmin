<?php
class BookController extends AppController{

	var $name = 'Book';

	function index(){

		$selectels = array();
		$selectels['type'] = 'select';
		$selectels['options'][0] = 'title';
		$selectels['options'][1] = 'isbn';

		$this->set('books', $this->Book->find('all'));
		$this->set('selectels', $selectels);

		if(!empty($this->data)){
		
			$search_str = $this->data['Book']['search_str'];
			$search_type = $this->data['Book']['type'];

			$rs_title = 'http://webcatplus.nii.ac.jp/index.html?type=equals-book&title='.$search_str;
			$rs_title = 'http://webcatplus.nii.ac.jp/webcatplus/details/book/isbn/'.$search_str.'.html';

echo $rs_title;
			echo htmlspecialchars(mb_convert_encoding(file_get_contents($rs_title), 'utf-8'), ENT_QUOTES);
				//print_r($_POST);
		}

	}

/*
	function view($id = null){
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());
	}

	function add(){
		if(!empty($this->data)){
			if($this->post->save($this->data)){
				$this->flash('your post has been saved','/posts');
			}
		}
	}
	
	function delete($id){
		$this->Post->delete($id);
		$this->flash('The post with id: '.$id.' has been deleted.', '/posts');
	}

	function edit(){
		$this->Post->id = $id;
		if(empty($this->data)){
			$this->data = $this->Post->read();
		}else if($this->Post->save($this->data['Post'])){
			$this->flash('The post has been updated.', '/posts');
		}
	}
*/

}
?>
